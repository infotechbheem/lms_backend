<?php

namespace App\Http\Controllers\Auth\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Membership;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses(){
        $courses = Course::all();
        $memberships = Membership::all();
        return view('auth.mentor.courses', compact('courses', 'memberships'));
    }
}
