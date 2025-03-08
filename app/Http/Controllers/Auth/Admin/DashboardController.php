<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashbaord()
    {
        return view('auth.admin.dashboard');
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
