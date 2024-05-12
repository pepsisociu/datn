<?php

namespace App\Models;

use App\Traits\ResponseTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ReservationLeave extends Model
{
    use HasFactory, ResponseTraits;

    protected $table = 'reservation_leave';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'date',
        'user_id',
        'status'
    ];

    /**
     * Relation with user
     *
     * @return void
     */
    public function user()
    {
        $this->hasOne(User::class);
    }

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelReservation = new Reservation();
    }


    public function addReservationLeave($request) {
        $reservationLeave = new ReservationLeave();
        $reservationLeave->date = date('Y-m-d', strtotime($request->date));
        $reservationLeave->start_time = $request->startTime;
        $reservationLeave->end_time = $request->endTime;
        $reservationLeave->status = true;
        $reservationLeave->user_id = Auth::id();
        $reservationLeave->save();
        $message = Lang::get('message.add_done');
        $status = true;
        return $this->responseData($status, $message, $reservationLeave);
    }
}
