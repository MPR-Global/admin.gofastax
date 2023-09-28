<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetTheTeam extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'name',
        'title',
        'profile_img',
        'review_link',
        'sequence',
        'leave_me_review_link',
        'created_by',
        'updated_by'
    ];

}
