<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'assignment_title', 'passing_percentage', 'retake_allowed'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class); // assuming Course model exists
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
