<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Membership;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function course()
{
    // Fetch student details for the authenticated user
    $student = Student::where('student_id', Auth::user()->username)->first();

    // Decode the JSON array of course IDs
    $courseIds = json_decode($student->course_id);

    $membershipIds = json_decode($student->membership_id);

    // Ensure that courseIds is an array
    if (is_array($courseIds) && !empty($courseIds)) {
        // Fetch courses by their IDs
        $courses = Course::whereIn('id', $courseIds)->get();
    } else {
        $courses = collect(); // Return an empty collection if no valid courses
    }

    // Ensure that membershipIds is an array
    if (is_array($membershipIds) && !empty($membershipIds)) {
        // Fetch courses by their IDs
        $memberships = Membership::whereIn('membership_id', $membershipIds)->get();
    } else {
        $memberships = collect(); // Return an empty collection if no valid courses
    }

    // Pass the courses to the view
    return view('auth.student.course', compact('courses', 'memberships'));
}

}
