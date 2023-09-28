<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleBookings extends Model
{
    //
    protected $fillable = [
        'booking_date',
        'time_slot',
        'email',
        'no_of_furnace',
        'created_date',
    ];
}
