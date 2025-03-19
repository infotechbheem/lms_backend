<?php

namespace App\Http\Middleware;

use App\Models\Student;
use App\Models\Volunteer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class VolunteerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('student')) {
                if (Volunteer::where('volunteer_id', $user->username)) {
                    $student = Student::where('student_id', $user->username)->first();
                    View::share(['volunteer' => $student]);
                    return $next($request);
                }
                Auth::logout();
                return redirect()->back()->with('warning', 'You are unauthorized person');
            } elseif ($user->hasRole('volunteer')) {
                return $next($request);
            }
            Auth::logout();
            return redirect()->back()->with('warning', 'You are unauthorized person');
        }
        return redirect('/volunteer-login')->with('warning', 'Session is expired');
    }
}
