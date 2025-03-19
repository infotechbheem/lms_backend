<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Auth\CredentialController;
use App\Http\Controllers\Controller;
use App\Jobs\SendClassReminder;
use App\Mail\SendMentorSuccessNotification;
use App\Mail\SendStudentRegistrationEmail;
use App\Mail\SendVolunteerSuccessNotification;
use App\Models\Course;
use App\Models\Membership;
use App\Models\Mentor;
use App\Models\QuestionAnswer;

use App\Models\Student;
use App\Models\StudentCallingResponseUpdate;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    public function student()
    {
        // Fetch students and users, and join them based on student_id and username
        $students = Student::join('users', 'students.student_id', '=', 'users.username')
            ->select('students.*', 'users.status')
            ->get();

        $mentors = Mentor::join('students', 'students.student_id', '=', 'mentors.mentor_id')->select('students.*')->get();

        $memberships = Membership::all();
        $courses = Course::all();

        return view('auth.admin.student.student', compact('students', 'mentors', 'memberships', 'courses'));
    }

    public function studentProfile($student_id)
    {
        $student = Student::where('student_id', $student_id)->first();

        $registeredStudents = Student::where('created_by', $student_id)->get();

        return view('auth.admin.student.view-student-details', compact('student', 'registeredStudents')); //
    }

    public function studentRegistration(Request $request)
    {
        try {
            $credentialObj = new CredentialController();

            $studentId = $credentialObj->generateStudentId();
            $password = $credentialObj->generatePassword();
            $data = [
                'student_id' => $studentId,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'mentor_id' => $request->mentor_id,
                'course_id' => json_encode($request->course_id),
                'membership_id' => json_encode($request->membership_id)
            ];

            if ($request->hasFile('profile_picture')) {
                $profileData = $request->file('profile_picture');

                $data['profile_picture'] = $profileData->store('student/profile-picture', 'public');
            }

            $studentResponse = Student::create($data);

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
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function callingStudentUpdateResponse()
    {
        $students = Student::all();
        return view('auth.admin.student.calling-student', compact('students'));
    }

    public function callingStudentUpdateResponseStore(Request $request)
    {

        try {
            DB::beginTransaction();

            $dbUpdateResponse = StudentCallingResponseUpdate::create([
                'student_id' => $request->student_id,
                'created_by' => Auth::user()->username,
                'response' => $request->response
            ]);

            if ($dbUpdateResponse) {
                DB::commit();
                return redirect()->back()->with('success', 'Student status updated successfully');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function mentorAllot()
    {
        $students = Student::all();

        $mentors = Mentor::join('students', 'students.student_id', '=', 'mentors.mentor_id')->select('students.*')->get();

        return view('auth.admin.student.mentor-allotment', compact('students', 'mentors'));
    }

    public function allotmentor(Request $request)
    {
        try {
            DB::beginTransaction();

            $alreadyAlloted = Mentor::where('mentor_id', $request->mentor_id)->exists();
            if ($alreadyAlloted) {
                DB::rollBack();
                return redirect()->back()->with('warning', 'Mentor is already allotted');
            }

            $mentorData = Mentor::create([
                'mentor_id' => $request->mentor_id,
            ]);

            if ($mentorData) {

                $getData = Student::where('student_id', $request->mentor_id)->first();
                $email = $getData->email;

                $details = [
                    'student_name' => $getData->first_name . ' ' . $getData->last_name,
                ];

                Mail::to($email)->send(new SendMentorSuccessNotification($details));

                DB::commit();
                return redirect()->back()->with('success', 'Mentor allotted successfully');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteMentor($mentor_id)
    {
        try {
            DB::beginTransaction();

            $mentorData = Mentor::where('mentor_id', $mentor_id)->first();
            $mentorData->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Mentor deleted successfully');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function registerVolunteer()
    {
        $students = Student::all();

        $volunteers = Volunteer::join('students', 'students.student_id', '=', 'volunteers.volunteer_id')->select('students.*')->get();

        return view('auth.admin.student.volunteer', compact('students', 'volunteers'));
    }

    public function storeVolunteer(Request $request)
    {
        try {
            DB::beginTransaction();

            $checkVolunteer = Volunteer::where('volunteer_id', $request->volunteer_id)->exists();

            if ($checkVolunteer) {
                DB::rollBack();
                return redirect()->back()->with('warning', 'Volunteer is already maked ');
            }

            $volunteerData = Volunteer::create([
                'volunteer_id' => $request->volunteer_id,
            ]);

            if ($volunteerData) {

                $getData = Student::where('student_id', $request->volunteer_id)->first();
                $email = $getData->email;

                $details = [
                    'student_name' => $getData->first_name . ' ' . $getData->last_name,
                ];

                Mail::to($email)->send(new SendVolunteerSuccessNotification($details));


                DB::commit();
                return redirect()->back()->with('success', 'Successfully volunteer is marked');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteVolunteer($volunteer_id)
    {
        try {
            DB::beginTransaction();

            $volunteerData = Volunteer::where('volunteer_id', $volunteer_id)->first();
            $volunteerData->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Volunteer deleted successfully');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function classReminder()
    {
        $students = Student::all();
        $memberships = Membership::all();
        $courses = Course::all();
        return view('auth.admin.student.class-reminder', compact('students', 'memberships', 'courses'));
    }

    public function sendClassReminder(Request $request)
    {
        try {
            // Get the selected student IDs
            $studentIds = $request->student_id;

            // Get the message content
            $messageContent = $request->input('text-message');

            // Handle the attachment if present
            $attachment = null;
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment')->store('attachments'); // Store the attachment in the storage folder
            }

            // Loop through each student and dispatch the job
            foreach ($studentIds as $studentId) {
                // Retrieve student by their student_id
                $student = Student::where('student_id', $studentId)->first();

                if ($student) {
                    // For Laravel versions before 5.5
                    dispatch(new SendClassReminder($student, $messageContent, $attachment));
                }
            }

            return redirect()->back()->with('success', 'Reminder has been sent to the selected students!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function studentDetails($student_id)
    {
        $student = Student::where('student_id', $student_id)->first();
        return view('auth.admin.student.update-student-details', compact('student'));
    }

    public function storeStudentUpdatedDetails(Request $request, $student_id)
    {
        // Update student details here and redirect back to the student details page with success message.
        try {
            DB::beginTransaction();

            // Find the student using the student_id
            $student = Student::where('student_id', $student_id)->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Student not found.');
            }

            // Update the student details
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->email = $request->email;
            $student->phone_number = $request->phone_number;
            $student->date_of_birth = $request->date_of_birth;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $student->city = $request->city;
            $student->state = $request->state;
            $student->zip_code = $request->zip_code;
            $student->country = $request->country;
            $student->emergency_contact_phone = $request->emergency_contact_phone;
            $student->emergency_contact_email = $request->emergency_contact_email;
            $student->occupation = $request->occupation;
            $student->annual_income = $request->annual_income;

            // Handle profile image upload if provided
            if ($request->hasFile('profile_image')) {
                // Delete the previous image if it exists
                if ($student->profile_picture && Storage::exists('public/' . $student->profile_picture)) {
                    Storage::delete('public/' . $student->profile_picture);
                }

                // Store the new profile image
                $profileData = $request->file('profile_image');
                $student->profile_picture = $profileData->store('student/profile-picture', 'public');
            }

            $student->save(); // Save updated details to the database

            DB::commit();

            // Redirect back to the student details page with success message
            return redirect()->route('admin.student', $student_id)->with('success', 'Student details updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function questionAnswering()
    {
        // Retrieve all question answers
        $questions = QuestionAnswer::all();

        // Encrypt the IDs of each question answer
        $encryptedQuestions = $questions->map(function ($question) {
            $question->encrypted_id = Crypt::encryptString($question->id);  // Encrypt the ID
            return $question;
        });

        // Return the view with encrypted question answers
        return view('auth.admin.student.question-answering', compact('questions', 'encryptedQuestions'));
    }

    public function viewQuestionAnswering($id)
    {

        $decrypt_id = Crypt::decryptString($id);

        $question = QuestionAnswer::where('id', $decrypt_id)->first();

        return view('auth.admin.student.view-question-answer', compact('question'));
    }

    public function submitQuestionAnsweringResponse(Request $request)
    {
        // dd($request->all());

        try {
            DB::beginTransaction();

            $data = [
                'answer' => $request->response,
                'status' => true,
            ];
            $multipleFiles = [];
            // Check if files were uploaded
            if ($request->hasFile('attachment')) {
                $files = $request->file('attachment');
                // Loop through each file and store it
                foreach ($files as $file) {
                    $filePath = $file->store('question-answer/attachments', 'public');
                    $multipleFiles[] = $filePath;  // Add each file path to the array
                }
                // Store the file paths as a JSON-encoded array
                $data['answer_with_attachment'] = json_encode($multipleFiles);
            }


            $response = QuestionAnswer::where('id', $request->id)->update($data);

            if ($response) {
                DB::commit();
                return redirect()->back()->with('success', 'Response submitted successfully');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to submit response');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
