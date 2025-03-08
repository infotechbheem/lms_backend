<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = "attendances";
    protected $fillable = [
        'student_name',
        'student_id',
        'course',
        'attendance_status',
        'attendnace_punctuality',
    ];
}
