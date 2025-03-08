<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'gender',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'emergency_contact_phone',
        'emergency_contact_email',
        'profile_picture',
        'occupation',
        'annual_income',
        'mentor_id',
        'course_id',
        'membership_id',
        'created_by'
    ];
}
