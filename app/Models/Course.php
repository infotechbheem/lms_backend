<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'course_title',
        'start_date',
        'end_date',
        'time',
        'cover_image',
        'discount_price',
        'membership_id',
        'description',
    ];
}
