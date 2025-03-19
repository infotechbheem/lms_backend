<?php

namespace App\Http\Controllers\Auth\Volunteer;

use App\Http\Controllers\Auth\CredentialController;
use App\Http\Controllers\Controller;
use App\Mail\SendStudentRegistrationEmail;
use App\Models\Course;
use App\Models\Membership;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class VolunteerWorkController extends Controller
{
    public function studentRegistration()
    {

        $courses = Course::all();
        $memberships = Membership::all();
        return view('auth.volunteer.student-registration', compact('courses', 'memberships'));
    }

    public function storeStudentRegistration(Request $request)
    {
        try {
            DB::beginTransaction();


            $credentialObj = new CredentialController();

            $studentId = $credentialObj->generateStudentId();
            $password = $credentialObj->generatePassword();

            $registrationData = [
                'student_id' => $studentId,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'emergency_contact_phone' => $request->emergency_contact_number,
                'emergency_contact_email' => $request->emergency_contact_email,
                'occupation' => $request->occupation,
                'annual_income' => $request->annual_income,
                'course_id' => json_encode($request->course),
                'membership_id' => json_encode($request->membership),
                'created_by' => Auth::user()->username,
            ];

            if ($request->hasFile('profile_image')) {
                $profileData = $request->file('profile_image');

                $registrationData['profile_picture'] = $profileData->store('student/profile-picture', 'public');
            }

            $studentResponse = Student::create($registrationData);

            $studentCreate = User::create([
                'username' => $studentId,
                'user_type' => 'student',
                'department' => 'student',
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => $password,
            ]);

            $student_role = Role::createOrFirst(['name' => 'student']);

            $studentCreate->assignRole($student_role);


            if ($studentResponse && $studentCreate) {
                $details = [
                    'student_id' => $studentId,
                    'student_name' => $request->first_name . ' ' . $request->first_name,
                    'email' => $request->email,
                    'password' => $password,
                ];

                Mail::to($request->email)->send(new SendStudentRegistrationEmail($details));

                DB::commit();
                return redirect()->back()->with('success', 'Student registration successfully');
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Error occurred while registering student');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function allRegisteredStudent()
    {
        // Retrieve all students created by the logged-in user
        $students = Student::where('created_by', Auth::user()->username)->get();

        // Encrypt the ID for each student
        $students->each(function ($student) {
            // Encrypt the student's ID
            $student->encrypted_id = Crypt::encrypt($student->id);
        });

        // Return the view with encrypted IDs
        return view('auth.volunteer.all-registered-student', compact('students'));
    }

    public function viewStudentDetails($student_id)
    {

        $descrypt_id = Crypt::decrypt($student_id);

        $student = Student::find($descrypt_id);

        return view('auth.volunteer.view-student-details', compact('student'));
    }
}
