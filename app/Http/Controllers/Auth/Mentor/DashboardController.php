<?php

namespace App\Http\Controllers\Auth\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Membership;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function numberOfStudentRegistered()
    {
        $getNoOfRecord = Student::where('created_by', Auth::user()->username)->orWhere('mentor_id', Auth::user()->username)->count();
        return $getNoOfRecord;
    }
    public function numberOfStudentRegisteredToday()
    {
        $getNoOfRecord = Student::where('created_by', Auth::user()->username)
                                ->orWhere('mentor_id', Auth::user()->username)
                                ->whereDate('created_at', Carbon::today())
                                ->count();
        return $getNoOfRecord;
    }

    public function numberOfStudentRegisteredYesterday()
    {
        $getNoOfRecord = Student::where('created_by', Auth::user()->username)
                                ->orWhere('mentor_id', Auth::user()->username)
                                ->whereDate('created_at', Carbon::yesterday())
                                ->count();
        return $getNoOfRecord;
    }
    public function numberOfStudentRegisteredThisMonth()
    {
        $getNoOfRecord = Student::where('created_by', Auth::user()->username)
                                ->orWhere('mentor_id', Auth::user()->username)
                                ->whereBetween('created_at', [
                                    Carbon::now()->startOfMonth(),  // Start of this month
                                    Carbon::now()->endOfMonth()     // End of this month
                                ])
                                ->count();
        return $getNoOfRecord;
    }
    
    public function dashbaord()
    {
        $courses = Course::all();
        $memberships = Membership::all();
        $students =Student::where('created_by', Auth::user()->username)->orWhere('mentor_id', Auth::user()->username)->get();

        $noOfStudent = $this->numberOfStudentRegistered();
        $noOfStudentToday  = $this->numberOfStudentRegisteredToday();
        $noOfStudentYesterday  = $this->numberOfStudentRegisteredYesterday();
        $noOfStudentThisMonth  = $this->numberOfStudentRegisteredThisMonth();


        return view("auth.mentor.dashboard", compact('courses', 'memberships', 'students', 'noOfStudent', 'noOfStudentToday', 'noOfStudentYesterday', 'noOfStudentThisMonth'));
    }

    public function mentorLogout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/mentor-login');
        }
        return redirect()->back()->with('warning', 'You are not allowed to log out');
    }

}
