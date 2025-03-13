<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingsLinksShow extends Model
{
    protected $table ='meeting_links_shows';
    protected $fillable = ['meeting_id', 'course_id', 'membership_id', 'student_id'];
}
