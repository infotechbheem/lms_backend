<?php

namespace App\Http\Controllers\Auth\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCurriculum;
use App\Models\Membership;
use App\Models\RecordedCourse;
use App\Models\Student;
use App\Models\StudentCallingResponseUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebApiController extends Controller
{
    public function getMembershipDetails(Request $request)
    {
        // Fetch the membership based on the ID
        $membership = Membership::where('membership_id',$request->membership_id)->first();
        
        if (!$membership) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Membership id does not exist.',
                ]
            );
        }

        // Fetch the course details based on the membership
        $course = Course::where('membership_id', $request->membership_id)->get();
        

        if (!$course) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Course not found.',
                ]
            );
        }

        // Fetch the recorded courses based on the membership
        return response()->json([
            'status' => true,
            'data' => $membership,
            
           'message' => 'Membership details retrieved successfully.',
        ]);
    }
    


    public function getCallingResponse(Request $request)
    {
        $getResponse = StudentCallingResponseUpdate::join('users', 'student_calling_response_updates.created_by', '=', 'users.username')
            ->select('student_calling_response_updates.*', 'users.name')->where('student_calling_response_updates.student_id', $request->student_id)->get();

        if ($getResponse) {
            return response()->json(
                [
                    'status' => true,
                    'data' => $getResponse,
                    'message' => 'Calling response retrieved successfully.',
                ]
            );
        }
        return response()->json(
            [
                'status' => false,
                'message' => 'No calling response found for this student.',
            ]
        );
    }

    public function getStudentRecord(Request $request)
    {
        // dd($request->all());

        $allStudent = Student::where('mentor_id', $request->mentor_id)->get();
        if ($allStudent) {
            return response()->json(
                [
                    'status' => true,
                    'data' => $allStudent,
                    'message' => 'Student record retrieved successfully.',
                ]
            );
        }
        return response()->json(
            [
                'status' => false,
                'message' => 'No student found for this mentor.',
            ]
        );

        
    }
    public function getStudentByMembership(Request $request)
    {
        $membershipId = $request->membership_id; // Assuming the request contains the 'membership_id'

        // Fetch the student records where the membership_id matches, and join with the courses table
        $students = Student::whereRaw("JSON_UNQUOTE(JSON_EXTRACT(students.membership_id, '$[0]')) = ?", [$membershipId])
            ->get(); // Fetch the records

        // dd($students);
        return response()->json([
            'students' => $students
        ]);
    }

    public function getStudentByCourse(Request $request)
    {
        // Get the provided course_id from the request
        $courseId = $request->course;
        
        // Fetch the student records where the course_id matches, and join with the courses table
        $students = Student::leftJoin('courses', 'students.course_id', '=', 'courses.id')
            ->whereRaw("JSON_VALID(students.course_id) AND JSON_UNQUOTE(JSON_EXTRACT(students.course_id, '$[0]')) = ?", [$courseId]) // Check for valid JSON
            ->select('students.*', 'courses.course_title')
            ->get(); // Fetch the records
    
            $course_title = Course::find($courseId)->value('course_title');

        return response()->json([
            'students' => $students,
            'course_title' => $course_title,
        ]);
    }
    
    
    
    
    

    public function getCourseDetails(Request $request){
        $courseId = $request->course_id;
        $getDetails = Course::find($courseId);
        if($getDetails){
            return response()->json(
                [
                   'status' => true,
                    'data' => $getDetails,
                   'message' => 'Course details retrieved successfully.',
                ]
            );
        }
        return response()->json(
            [
               'status' => false,
               'message' => 'No course found for this ID.',
            ]
        );
    }

    public function getMaterialDetails(Request $request){
        $materialId = $request->course_id;
        $courseDetails = RecordedCourse::where('course_id', $materialId)->first();

        if(!$courseDetails){
            return response()->json([
                'status' => false,
                'message' => "Course material details not found"
            ]);
        }

        $courseMaterialDetails = CourseCurriculum::where('course_id', $materialId)->get();

        if(!$courseMaterialDetails){
            return response()->json([
                'status' => false,
                'message' => "Course material details not found"
            ]);
        }  
        
        return response()->json([
            'status' => true,
            'course_material_details' => $courseDetails,
            'course_material_curriculum' => $courseMaterialDetails,
        ]);

    }
    
}