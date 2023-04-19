<?php

namespace App\Models;

use App\Http\Controllers\ReservationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ResponseTraits;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Lang;

class Reservation extends Model
{
    use HasFactory, ResponseTraits;

    const TIME_ACCEPT = ["8:00", "8:20", "8:40",
        "9:00", "9:20", "9:40",
        "10:00", "10:20", "10:40",
        "11:00", "11:20", "11:40",
        "12:00", "12:20", "12:40",
        "13:00", "13:20", "13:40",
        "14:00", "14:20", "14:40",
        "15:00", "15:20", "15:40",
        "16:00", "16:20", "16:40",
        "17:00", "17:20", "17:40",
        "18:00", "18:20", "18:40",
        "19:00", "19:20", "19:40"];

    protected $table = 'reservation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'doctor_id',
        'user_id',
        'date',
        'time',
        'message',
        'status',
    ];

    private $model;
    private $url;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = Config::get('app.image.url');
    }

    /**
     * Relation with user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Relation with doctor
     *
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function getReservations($request)
    {
        try {
            $startDate = date('Y-m-d', strtotime(substr($request->date, 0, 10)));
            $endDate = date('Y-m-d', strtotime(substr($request->date, 13, 23)));
            $data = Reservation::whereDate('date', '<=', $startDate)->whereDate('date', '>=', $endDate)->orderBy('id', 'DESC')->get();
            $status = true;
            $message = null;
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    public function getReservation($id)
    {
        try {
            $data = Reservation::find($id);
            $status = true;
            $message = null;
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    public function updateReservation($request, $id)
    {
        try {
            $data = null;
            $reservation = Reservation::find($id);
            $reservation->status = $request->status == 'on' ? 1 : 0;
            if (isset($request->doctor_id) && $request->doctor_id != null) ;
            {
                $reservation->doctor_id = $request->doctor_id;
            }
            $reservation->save();
            $status = true;
            $message = Lang::get('message.update_done');;
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
        }
        return $this->responseData($status, $message, $data);
    }

    public function getFreeTime($request)
    {
        $reservation = Reservation::where('date', $request->date)->where('doctor_id', $request->doctor)->where('status', 1)->get();
        $time = $reservation->pluck('time')->map(function ($time) {
            return date('H:i', strtotime($time));
        });
        return array_diff(self::TIME_ACCEPT, $time->toArray());
    }
}
