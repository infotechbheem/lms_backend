<?php

namespace App\Http\Controllers\Auth\Mentor;

use App\Http\Controllers\Controller;
use App\Models\SadhanaReport;
use App\Models\Student;
use App\Models\StudentCallingResponseUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function report()
    {
        // Get the student IDs based on the current user's username
        $student_id = Student::where('created_by', Auth::user()->username)
            ->orWhere('mentor_id', Auth::user()->username)
            ->pluck('student_id');  // Get all student_ids for the current user
    
        // Paginate the sadhana reports, 10 reports per page (adjust the number as needed)
        $sadhana_reports = SadhanaReport::join('students', 'students.student_id', '=', 'sadhana_reports.student_id')
            ->whereIn('sadhana_reports.student_id', $student_id)  // Filter by the student IDs
            ->select('sadhana_reports.*', 'students.first_name', 'students.last_name')  // Select required columns
            ->paginate(10);  // Adjust the number as needed
    
    
        $students = Student::where('mentor_id', Auth::user()->username)->orWhere('created_by', Auth::user()->username)->get();

        $calling_response = StudentCallingResponseUpdate::join('students', 'students.student_id',  '=' , 'student_calling_response_updates.student_id')
            ->where('student_calling_response_updates.created_by', Auth::user()->username)
            ->select('student_calling_response_updates.*','students.first_name','students.last_name', 'students.phone_number')
            ->paginate(10);

        return view('auth.mentor.reports', compact('sadhana_reports', 'students', 'calling_response'));
    }


    

}
