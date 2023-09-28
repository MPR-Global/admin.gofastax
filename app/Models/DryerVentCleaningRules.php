<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DryerVentCleaningRules extends Model
{
    //
    protected $fillable = [
        'dryer_vent_exit_point',
        'price',
        'updated_by',
    ];
}
