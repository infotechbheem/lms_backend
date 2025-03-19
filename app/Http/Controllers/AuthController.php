<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\Volunteer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }

    public function adminLogin(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin-login')->withErrors($validator)->withInput();
        }
        try {
            // Determine if the input is email or username
            $input = $request->only('username', 'password');
            $field = filter_var($input['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            // Attempt to authenticate the user
            if (Auth::attempt([$field => $input['username'], 'password' => $input['password']])) {
                $user = Auth::user();
                // Redirect based on the user role
                if ($user->hasRole('admin')) {
                    // Fetch the mail details for this ngo_id from the database
                    return redirect()->route('admin.dashboard');
                }
                // If the user does not have a recognized role, log them out
                Auth::logout();
                return redirect('/admin-login')->with('failed', 'You do not have access to this area.');
            }

            // If the login fails, redirect back to the login page with an error message
            return redirect('/admin-login')->with('failed', 'Invalid credentials.');
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function studentLogin(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/student-login')->withErrors($validator)->withInput();
        }
        try {
            // Determine if the input is email or username
            $input = $request->only('username', 'password');
            $field = filter_var($input['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            // Attempt to authenticate the user
            if (Auth::attempt([$field => $input['username'], 'password' => $input['password']])) {
                $user = Auth::user();
                // Redirect based on the user role
                if ($user->hasRole('student')) {
                    // Fetch the mail details for this ngo_id from the database
                    return redirect()->route('student.dashboard');
                }
                // If the user does not have a recognized role, log them out
                Auth::logout();
                return redirect('/student-login')->with('failed', 'You do not have access to this area.');
            }

            // If the login fails, redirect back to the login page with an error message
            return redirect('/student-login')->with('failed', 'Invalid credentials.');
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
    public function mentorLogin(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/student-login')->withErrors($validator)->withInput();
        }
        try {
            // Determine if the input is email or username
            $input = $request->only('username', 'password');
            $field = filter_var($input['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            // Attempt to authenticate the user
            if (Auth::attempt([$field => $input['username'], 'password' => $input['password']])) {
                $user = Auth::user();
                // Redirect based on the user role
                if ($user->hasRole('mentor')) {
                    return redirect()->route('mentor.dashboard');
                } else if ($user->hasRole('student')) {

                    if (Mentor::where('mentor_id', $user->username)->exists()) {
                        dd($user->usermname);
                        // Fetch the mail details for this ngo_id from the database
                        return redirect()->route('mentor.dashboard');
                    }
                    Auth::logout();
                    return redirect('/mentor-login')->with('failed', 'You do not have access to this area.');
                }
                // If the user does not have a recognized role, log them out
                Auth::logout();
                return redirect('/mentor-login')->with('failed', 'You do not have access to this area.');
            }

            // If the login fails, redirect back to the login page with an error message
            return redirect('/mentor-login')->with('failed', 'Invalid credentials.');
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
    public function volunteerLogin(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/volunteer-login')->withErrors($validator)->withInput();
        }
        try {
            // Determine if the input is email or username
            $input = $request->only('username', 'password');
            $field = filter_var($input['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            // Attempt to authenticate the user
            if (Auth::attempt([$field => $input['username'], 'password' => $input['password']])) {
                $user = Auth::user();
                // Redirect based on the user role
                if ($user->hasRole('volunteer')) {
                    return redirect()->route('volunteer.dashboard');
                } else if ($user->hasRole('student')) {
                    if (Volunteer::where('volunteer_id', $user->username)->exists()) {
                        // Fetch the mail details for this ngo_id from the database
                        return redirect()->route('volunteer.dashboard');
                    }
                    Auth::logout();
                    return redirect('/volunteer-login')->with('failed', 'You do not have access to this area.');
                }
                // If the user does not have a recognized role, log them out
                Auth::logout();
                return redirect('/volunteer-login')->with('failed', 'You do not have access to this area.');
            }

            // If the login fails, redirect back to the login page with an error message
            return redirect('/volunteer-login')->with('failed', 'Invalid credentials.');
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
