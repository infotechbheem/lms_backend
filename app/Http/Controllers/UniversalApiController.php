<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Membership;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\JsonDecoder;

class UniversalApiController extends Controller
{
    public function checkEmail(Request $request){
        // dd($request->all());

        $checkEmail = User::where("email", operator: $request->email)->first();
        if($checkEmail){
            return response()->json([
                "status"=> true,
                "message"=> "Email allready registered"
                ]);
        }else{  
            return response()->json([
                "status"=> false,
            ]);
        }
    }
    public function checkPhoneNumber(Request $request){
        // dd($request->all());

        $checkPhoneNumber = Student::where("phone_number",  $request->phone_number)->first();
        if($checkPhoneNumber){
            return response()->json([
                "status"=> true,
                "message"=> "Mobile Number allready registered"
                ]);
        }else{  
            return response()->json([
                "status"=> false,
            ]);
        }
    }

    public function getMembershipDetails(Request $request)
    {
        // Validate the membership ID
        $request->validate([
            'membership_id' => 'required|exists:memberships,membership_id', // Ensuring membership_id exists
        ]);
    
        // Retrieve the membership details
        $getMembership = Membership::where('membership_id', $request->membership_id)->first();
    
        if (!$getMembership) {
            return response()->json(['error' => 'Membership not found']);
        }
    
        // Decode the course_id field from JSON
        $courseDetails = json_decode($getMembership->course_id, true);
    
        // Check if the courseDetails is a valid array
        if (!is_array($courseDetails) || empty($courseDetails)) {
            return response()->json(['error' => 'No courses found for this membership']);
        }
    
        // Fetch course details from the Course table
        $courses = Course::whereIn('id', $courseDetails)->get();
    
        // Check if courses are found
        if ($courses->isEmpty()) {
            return response()->json(['error' => 'No matching courses found']);
        }
    
        // Return the courses as a JSON response
        return response()->json([
            'status' => true,
            'membership' => $getMembership,
            'courses' => $courses,
        ]);
    }

}
