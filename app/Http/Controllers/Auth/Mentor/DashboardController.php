<?php

namespace App\Http\Controllers\Auth\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Membership;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\get;

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
        $students = Student::where('created_by', Auth::user()->username)->orWhere('mentor_id', Auth::user()->username)->get();

        $noOfStudent = $this->numberOfStudentRegistered();
        $noOfStudentToday = $this->numberOfStudentRegisteredToday();
        $noOfStudentYesterday = $this->numberOfStudentRegisteredYesterday();
        $noOfStudentThisMonth = $this->numberOfStudentRegisteredThisMonth();

        $monthlyRegistrations = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where(function ($query) {
                $query->where('created_by', Auth::user()->username)
                    ->orWhere('mentor_id', Auth::user()->username);
            })
            ->whereYear('created_at', '=', now()->year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('count', 'month')
            ->toArray();

        // Fill missing months with 0 registrations
        for ($i = 1; $i <= 12; $i++) {
            $monthlyRegistrations[$i] = $monthlyRegistrations[$i] ?? 0;
        }



        $newRegistrationDone = Student::where('created_by', Auth::user()->username)
            ->whereDate('created_at', '>=', Carbon::now()->startOfMonth()) // Start of the current month
            ->whereDate('created_at', '<=', Carbon::now()->endOfMonth())   // End of the current month
            ->count();

        $chooses_as_a_mentor = Student::where('mentor_id', Auth::user()->username)
            ->whereDate('created_at', '>=', Carbon::now()->startOfMonth()) // Start of the current month
            ->whereDate('created_at', '<=', Carbon::now()->endOfMonth())   // End of the current month
            ->count();


        return view("auth.mentor.dashboard", compact(
            'courses',
            'memberships',
            'students',
            'noOfStudent',
            'noOfStudentToday',
            'noOfStudentYesterday',
            'noOfStudentThisMonth',
            'monthlyRegistrations',
            'newRegistrationDone',
            'chooses_as_a_mentor',
        ));
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
