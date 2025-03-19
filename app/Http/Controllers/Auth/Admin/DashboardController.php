<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashbaord()
    {
        $totalStudentRegistered = Student::count();
        $totalMemtorEnrolled = Mentor::count();
        $totalVolunteerEnrolled = Volunteer::count();
        $totalCourseUpdated = Course::count();
        return view('auth.admin.dashboard', compact('totalStudentRegistered', 'totalMemtorEnrolled', 'totalVolunteerEnrolled', 'totalCourseUpdated'));
    }


    public function adminLogout()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            Auth::logout();
            return redirect('/admin-login')->with('success', 'You have been logged out successfully.');
        } else {
            // If the user doesn't have the 'admin' role
            return redirect('/admin-login')->with('failed', 'You do not have the required role to perform this action.');
        }
    }
}
