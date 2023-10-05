<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reviews extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'name',
        'review_date',
        'description',
        'image',
        'created_by',
        'updated_by'
    ];
}
