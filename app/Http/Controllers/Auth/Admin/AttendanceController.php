<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Holiday;
use App\Models\Membership;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{

    public function addAttendance()
    {

        $students = Student::all();
        $memberships = Membership::all();
        $courses = Course::all();
        return view('auth.admin.attendance.add-attendance', compact( 'students', 'courses', 'memberships'));
    }

    public function storeAttendance(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'attendances'                     => 'required|array', // Expect an array of attendance records
            'attendances.*.student_name'       => 'required',
            'attendances.*.student_id'         => 'required',
            'attendances.*.course'             => 'required_without:attendances.*.membership',
            'attendances.*.membership'         => 'required_without:attendances.*.course',
            'attendances.*.attendance_status'  => 'required',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            DB::beginTransaction();
    
            foreach ($request->attendances as $attendance) {
    
                $attendance_status = $attendance['attendance_status'];
                $student_id = $attendance['student_id'];
                $student_name = $attendance['student_name'];
                $selected_id = isset($attendance['membership']) ? $attendance['membership'] : (isset($attendance['course']) ? $attendance['course'] : null);
    

                // Check if attendance record already exists for the student on the current date
                $existingAttendance = Attendance::where('student_id', $student_id)
                    ->where('selected_id', $selected_id)
                    ->whereDate('created_at', now()->toDateString())
                    ->first();
    
                if ($existingAttendance) {
                    // Update existing record
                    $existingAttendance->update([
                        'student_name'        => $student_name,
                        'selected_id'         => $selected_id,
                        'attendance_status'   => $attendance_status,
                        'updated_at'          => now(),
                    ]);
                } else {
                    // Insert new record
                    Attendance::create([
                        'student_name'        => $student_name,
                        'student_id'          => $student_id,
                        'selected_id'         => $selected_id,
                        'attendance_status'   => $attendance_status,
                        'created_at'          => now(),
                        'updated_at'          => now(),
                    ]);
                }
            }
    
            // Commit the transaction
            DB::commit();
            return redirect()->back()->with('success', 'Attendance updated/created successfully for all students!');
        } catch (\Throwable $th) {
            // Rollback the transaction on error
            DB::rollBack();
            dd($th);
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }
    

    public function viewAttendance()
    {
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
            ->groupBy('student_id')
            ->get();

        return view('auth.admin.attendance.view-attendance', compact('attendances'));
    }
}
