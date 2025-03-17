<?php

namespace App\Http\Controllers\Auth\Mentor;

use App\Http\Controllers\Auth\CredentialController;
use App\Http\Controllers\Controller;
use App\Mail\SendStudentRegistrationEmail;
use App\Models\SadhanaReport;
use App\Models\Student;
use App\Models\StudentCallingResponseUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    public function storeStudentRegistration(Request $request){

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

    public function student(){

        $students = Student::where('mentor_id', Auth::user()->username)->orWhere('created_by', Auth::user()->username)->paginate(10);  // Adjust the number as needed

        return view('auth.mentor.student', compact('students'));
    }

    public function studentProfile($student_id){

        $student = Student::where('student_id', $student_id)->first();
      
        // Paginate the sadhana reports, 10 reports per page (adjust the number as needed)
        $sadhana_reports = SadhanaReport::where('student_id', $student_id)  // Filter by the student IDs
        ->paginate(10);  // Adjust the number as needed
      
        $calling_response = StudentCallingResponseUpdate::join('students', 'students.student_id',  '=' , 'student_calling_response_updates.student_id')
        ->where('student_calling_response_updates.student_id', $student_id)
        ->select('student_calling_response_updates.*','students.first_name','students.last_name', 'students.phone_number')
        ->paginate(10);
      
        return view('auth.mentor.view-student-details', compact('student', 'sadhana_reports', 'calling_response'));
    }

    public function SubmitResponse(Request $request){
        try {
            DB::beginTransaction();

            $callingResponse = [
                'student_id' => $request->student_id,
                'created_by' => Auth::user()->username,
                'response' => $request->calling_response,
            ];

            StudentCallingResponseUpdate::create($callingResponse);
            DB::commit();
            return redirect()->back()->with('success', 'Response submitted successfully');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
