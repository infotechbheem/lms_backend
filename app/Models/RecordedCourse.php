<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordedCourse extends Model
{
    protected $table = "recorded_courses";
    protected $fillable = [
        'course_id',
        'question_answer_access',
        'comments',
        'level',
        'thumbnail',
        'intro_video_path',
        'duration',
        'video_quality',
        'upload_date',
    ];
}
