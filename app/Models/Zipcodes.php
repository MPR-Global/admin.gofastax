<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zipcodes extends Model
{
    protected $table = 'zipcodes';
    protected $fillable = [
        'zipcode',
        'city',
        'county',
        'coverage',
        'additional_price',
        'duration_from_amistee',
        'distance_from_amistee',
    ];
}
