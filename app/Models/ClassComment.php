<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassComment extends Model
{
    protected $table = 'class_comments';
    protected $fillable = ['comment', 'student_id','student_name', 'section_number', 'chapter_number'];
}
