<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirDuctCleaningRules extends Model
{
    //
    protected $fillable = [
        'num_furnace',
        'square_footage_min',
        'square_footage_max',
        'furnace_loc_sidebyside',
        'furnace_loc_different',
        'final_price',
        'updated_by',
    ];
}
