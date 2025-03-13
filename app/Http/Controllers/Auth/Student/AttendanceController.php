<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Membership;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function viewAttendance()
    {
        // Get authenticated user
        $user = Auth::user();
        $std_id = $user->username;
    
        // Decode course_id and membership_id if stored as JSON
        $course_id = Student::where('student_id', $std_id)->value('course_id');
        $decoded_course_id = json_decode($course_id, true);
        $courses = Course::whereIn('id', $decoded_course_id)->get(); 
    
        // dd($courses);
        $membership_id = Student::where('student_id', $std_id)->value('membership_id');
        $decoded_membership_id = json_decode($membership_id, true);
    
       // Fetch membership course ids from the membership table
        $membership_course_ids = Course::whereIn('membership_id', $decoded_membership_id)->pluck('id');

        // Flatten and decode all course_ids from the membership records
        $all_membership_course_ids = [];

        // Since $membership_course_ids is already an array of integers, we don't need to json_decode()
        foreach ($membership_course_ids as $course_id) {
            // If each $course_id itself was supposed to be a JSON string (it might be), decode it.
            // But since we're working with IDs directly, we just add them to the array.
            $all_membership_course_ids[] = $course_id;
        }

        // dd($all_membership_course_ids);

        // Remove duplicates if any
        $all_membership_course_ids = array_unique($all_membership_course_ids);
    
        // Fetch full course details based on the extracted course IDs for membership courses
        $membership_courses = Course::whereIn('id', $all_membership_course_ids)->get();
    
        // Merge courses and membership_courses collections
        $combined_courses = $courses->merge($membership_courses);
    
        // Remove duplicates by course id
        $unique_courses = $combined_courses->unique('id');



         // Get the start and end date of the current month
         $startOfMonth = Carbon::now()->startOfMonth();
         $endOfMonth   = Carbon::now()->endOfMonth();
 
         // Fetch attendance data grouped by employee for the current month
         $attendances = DB::table('attendances')
             ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
             ->select(
                 'student_id',
                 DB::raw('MAX(student_name) as student_name'),
                 DB::raw('MAX(course) as courses'),
                 DB::raw('GROUP_CONCAT(attendance_status ORDER BY created_at ASC) as attendance_statuses'),
                 DB::raw('GROUP_CONCAT(DATE(created_at) ORDER BY created_at ASC) as attendance_dates'),
                 DB::raw('GROUP_CONCAT(TIME(created_at) ORDER BY created_at ASC) as attendance_in_times'),
                 DB::raw('GROUP_CONCAT(attendnace_punctuality ORDER BY created_at ASC) as attendnace_punctualities')
             )
             ->where('student_id', $std_id)
             ->groupBy('student_id')
             ->get();
        

        return view('auth.student.attendance', compact('unique_courses', 'attendances'));
    }
}
