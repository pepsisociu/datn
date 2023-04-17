<?php

namespace App\Models;

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
            $data = Reservation::whereDate('date','<=', $startDate)->whereDate('date','>=', $endDate)->orderBy('id', 'DESC')->get();
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
            if (isset( $request->doctor_id ) &&  $request->doctor_id != null); {
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



}
