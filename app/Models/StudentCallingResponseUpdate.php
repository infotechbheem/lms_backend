<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCallingResponseUpdate extends Model
{
    protected $table = 'student_calling_response_updates';
    protected $fillable = [
        'student_id',
        'created_by',
        'response',
    ];
}
