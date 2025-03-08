<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use App\Models\NewsLatters;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashbaord()
    {
        return view('auth.student.dashboard');
    }

    public function studentLogout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/student-login');
        } else {
            return redirect()->back()->with('warning', 'You are not allowed to log out');
        }
    }

    public function updateProfileDetails(Request $request)
    {
        try {
            DB::beginTransaction();
    
            // Prepare data to update student details
            $requestedData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip_code' => $request->zip_code,
                'emergency_contact_phone' => $request->emergency_contact_number,
                'emergency_contact_email' => $request->emergency_contact_email,
                'occupation' => $request->occupation,
                'annual_income' => $request->annual_income,
            ];
    
            // If a new profile picture is uploaded, handle the file upload and remove the old one
            if ($request->hasFile('profile_picture')) {
                // Delete the old profile picture if it exists
                $user = Auth::user();
                $student = Student::where('student_id', $user->username)->first();
    
                if ($student && $student->profile_picture) {
                    // Delete the old file from the storage
                    Storage::disk('public')->delete($student->profile_picture);
                }
    
                // Store the new profile picture
                $profileData = $request->file('profile_picture');
                $requestedData['profile_picture'] = $profileData->store('student/profile-picture', 'public');
            }
    
            // Prepare the user data update
            $updateUserDetails = [];
            if ($request->first_name) {
                $updateUserDetails['first_name'] = $request->first_name;
            }
            if ($request->last_name) {
                $updateUserDetails['last_name'] = $request->last_name;
            }
            if ($request->email) {
                $updateUserDetails['email'] = $request->email;
            }
    
            // Construct the full name
            $userData = [
                'name' => $updateUserDetails['first_name'] . ' ' . $updateUserDetails['last_name'] ?? null,
                'email' => $updateUserDetails['email'],
            ];
    
            // Update the User table with the new data
            $user = User::where('username', Auth::user()->username)->update($userData);
    
            // Update the Student table with the new data
            $dbresponse = Student::where('student_id', Auth::user()->username)->update($requestedData);
    
            // If the update was successful, commit the transaction
            if ($dbresponse) {
                DB::commit();
                return redirect()->back()->with('success', 'Profile updated successfully');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to update profile');
            }
    
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }
    }
    
    
    public function profile(){
        return view('auth.student.profile');
    }

    public function subscribeNewslatters(Request $request){
        $validator = Validator::make($request->all(),[
            'email' =>'string|email|required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $requestedData = [
                'email' => $request->email,
            ];

            $dbresponse = NewsLatters::create($requestedData);

            if ($dbresponse) {
                DB::commit();
                return redirect()->back()->with('success', 'Subscribed to newsletters successfully');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to subscribe to newsletters');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: '. $th->getMessage());
        }
    }

    public function updatePasswordChange(Request $request){
        try {
             // Validate the inputs
         $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6', // Make sure password confirmation matches
        ]);

        $user = Auth::user();

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'The old password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);
        } catch (\Throwable $th) {
            
            DB::rollBack();
            return response()->json(['success'=> false, 'message'=> $th->getMessage()]);
        }
    }
}
