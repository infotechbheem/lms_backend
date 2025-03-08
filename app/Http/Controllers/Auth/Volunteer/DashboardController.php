<?php

namespace App\Http\Controllers\Auth\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashbaord()
    {
        return view('auth.volunteer.dashboard');
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
