<?php

namespace App\Http\Middleware;

use App\Models\Mentor;
use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class MentorAuthMiddleware
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
                if (Mentor::where('mentor_id', $user->username)) {
                    $profileImage = Student::where('student_id', $user->username)->value('profile_picture');
                    View::share(['mentor_profile_image' => $profileImage]);
                    return $next($request);
                }
                Auth::logout();
                return redirect()->back()->with('warning', 'You are unauthorized person');
            } elseif ($user->hasRole('mentor')) {
                return $next($request);
            }
            Auth::logout();
            return redirect()->back()->with('warning', 'You are unauthorized person');
        }
        return redirect('/mentor-login')->with('warning', 'Session is expired');
    }
}
