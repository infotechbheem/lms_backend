<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCurriculum extends Model
{
    protected $table = "course_curriculum";

    protected $fillable = [
        'course_id',
        'section_title',
        'chapter_number',
        'section_number',
        'chapter_name',
        'chapter_content',
        'pdf_material',
        'video_material',
    ];
}
