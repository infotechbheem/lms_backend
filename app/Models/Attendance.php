<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = "attendances";
    protected $fillable = [
        'student_name',
        'student_id',
        'selected_id',
        'attendance_status',
        'attendnace_punctuality',
    ];
}
