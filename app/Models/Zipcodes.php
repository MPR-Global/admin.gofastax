<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zipcodes extends Model
{
    use HasFactory, SoftDeletes;

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
