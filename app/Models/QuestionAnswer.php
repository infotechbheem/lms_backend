<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = 'question_answers';
    protected $fillable = [
        'student_id', 'course_id', 'questions', 'question_with_attachment', 'answer', 'answer_with_attachment'
    ];
}
