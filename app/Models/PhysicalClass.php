<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalClass extends Model
{
    protected $table = 'physical_classes';
    protected $fillable = [
        'course_title',
        'class_title',
        'class_type',
        'start_date',
        'end_date',
        'time',
        'venue',
        'cover_image',
        'coordinator',
        'fee_type',
        'currency',
        'discount_price',
        'description',
        'membership_id',
    ];
}
