<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class StudentAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Check if the user is authenticated
    if (Auth::check()) {
        $user = Auth::user();

        // Check if the user has the 'student' role
        if ($user->hasRole('student')) {

            // Fetch student data using a right join between 'students' and 'users' tables
            $student = Student::rightJoin('users', 'students.student_id', '=', 'users.username')
                              ->where('users.username', $user->username)
                              ->first();

            // If no student data is found, redirect with a warning
            if (!$student) {
                return redirect()->back()->with('warning', 'Student details not found');
            }

            $courseId = Student::where('student_id', $user->username)->first();

            $course_decoded = json_decode($courseId->course_id, true);
            
            // Join the students table with the courses table using the decoded course ids
            $courses = Course::whereIn('id', $course_decoded)  // Assuming `course_id` is the column in `courses` table
            ->get();
            // Share the student data with the view
            View::share(['student' => $student, 'courses' => $courses]);

            // Proceed to the next middleware/request handler
            return $next($request);
        }

        // Logout and redirect if the user is not authorized
        Auth::logout();
        return redirect()->back()->with('warning', 'You are not authorized to access this page');
    }

    // Redirect to login page if session expires or user is not authenticated
    return redirect('/student-login')->with('warning', 'Session expired. Kindly login again');
}

}
