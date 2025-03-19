<?php

namespace App\Http\Controllers\Auth\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function dashbaord()
    {
        // Count registrations for today
        $todayRegistration = Student::where('created_by', Auth::user()->username)
            ->whereDate('created_at', Carbon::today())
            ->count();

        // Count registrations for yesterday
        $yesterdayRegistration = Student::where('created_by', Auth::user()->username)
            ->whereDate('created_at', Carbon::yesterday())
            ->count();

        // Count registrations for the current month
        $currentMonthRegistration = Student::where('created_by', Auth::user()->username)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Pass the data to the view
        return view('auth.volunteer.dashboard', compact('todayRegistration', 'yesterdayRegistration', 'currentMonthRegistration'));
    }


    public function volunteerLogout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/volunteer-login');
        }
        return redirect()->back()->with('warning', 'You are not allowed to logout'); //
    }
}
