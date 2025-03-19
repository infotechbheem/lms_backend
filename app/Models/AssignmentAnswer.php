<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentAnswer extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name is plural of the model)
    protected $table = 'assignment_answers';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'assignment_id',
        'question_id',
        'student_id', // Add student_id field here
        'answer',
    ];

    // Define the relationship with the Assignment model
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Define the relationship with the Question model
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Define the relationship with the Student (User) model
}
