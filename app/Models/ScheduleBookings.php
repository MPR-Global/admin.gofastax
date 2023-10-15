<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleBookings extends Model
{
    use HasFactory, SoftDeletes;
    //
    protected $fillable = [
        'booking_date',
        'time_slot',
        'email',
        'no_of_furnace',
        'created_date',
    ];
}
