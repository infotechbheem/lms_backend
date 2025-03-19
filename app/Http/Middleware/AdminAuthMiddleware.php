<?php

namespace App\Http\Middleware;

use App\Models\Membership;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
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
            if ($user->hasRole('admin')) {

                $memberships = Membership::all();
                View::share([
                    'memberships' => $memberships,
                ]);

                return $next($request);
            }
            Auth::logout();
            return redirect()->back()->with('warning', 'Your are unauthorize person.');
        }
        return redirect('/admin-login')->with("warning", "Session Expires kindly login again");
    }
}
