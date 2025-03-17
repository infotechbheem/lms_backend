<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ClassComment;
use App\Models\CourseCurriculum;
use App\Models\MeetingsLinksShow;
use App\Models\Membership;
use App\Models\SadhanaReport;
use App\Models\Student;
use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class StudentCourseController extends Controller
{
    public function course()
    {
        // Fetch student details for the authenticated user
        $student = Student::where('student_id', Auth::user()->username)->first();

        // Decode the JSON array of course IDs
        $courseIds = json_decode($student->course_id);

        $membershipIds = json_decode($student->membership_id);

        // Ensure that courseIds is an array
        if (is_array($courseIds) && !empty($courseIds)) {
            // Fetch courses by their IDs
            $courses = Course::whereIn('id', $courseIds)->get();
        } else {
            $courses = collect(); // Return an empty collection if no valid courses
        }

        // Ensure that membershipIds is an array
        if (is_array($membershipIds) && !empty($membershipIds)) {
            // Fetch courses by their IDs
            $memberships = Membership::whereIn('membership_id', $membershipIds)->get();
        } else {
            $memberships = collect(); // Return an empty collection if no valid courses
        }

        // Pass the courses to the view
        return view('auth.student.course', compact('courses', 'memberships'));
    }

    public function liveClasses() {
        // Retrieve the meetings link details
        $getMeetingsLinkDetails = MeetingsLinksShow::all();
    
        $meetingIds = [];  // Array to store all matching meeting IDs
    
        // Retrieve the logged-in student's record
        $getStudentRecord = Student::where('student_id', Auth::user()->username)->first();
    
        // Decode the course_id and membership_id from the student's record
        $course_id = json_decode($getStudentRecord->course_id, true);  // Ensure it's decoded as an array
        $membership_id = json_decode($getStudentRecord->membership_id, true);  // Ensure it's decoded as an array
    
        // Iterate through each meeting link record
        foreach ($getMeetingsLinkDetails as $meetingLink) {
            // Decode the student_id, course_id, and membership_id from the meeting link
            $decodedStudentIds = json_decode($meetingLink->student_id, true); // Decode JSON into an array
            $decodedCourseIds = json_decode($meetingLink->course_id, true); // Decode JSON into an array
            $decodedMembershipIds = json_decode($meetingLink->membership_id, true); // Decode JSON into an array
    
            // Check if the logged-in student_id exists in the decoded student_id array
            if ($decodedStudentIds && is_array($decodedStudentIds)) {
                if (in_array(Auth::user()->username, $decodedStudentIds)) {
                    // If the student_id matches, store the meeting_id
                    $meetingIds[] = $meetingLink->meeting_id;  // Store all matching meeting IDs
                }
            }
    
            // Check if the logged-in student_id is a member of any course
            if (is_array($course_id) && !empty($course_id) && is_array($decodedCourseIds)) {
                // If any course matches, store the meeting_id
                $matchingCourses = array_intersect($course_id, $decodedCourseIds);
                if (!empty($matchingCourses)) {
                    $meetingIds[] = $meetingLink->meeting_id;
                }
            }
    
            // Check if the logged-in student_id is a member of any membership
            if (is_array($membership_id) && !empty($membership_id) && is_array($decodedMembershipIds)) {
                // If any membership matches, store the meeting_id
                $matchingMemberships = array_intersect($membership_id, $decodedMembershipIds);
                if (!empty($matchingMemberships)) {
                    $meetingIds[] = $meetingLink->meeting_id;
                }
            }
        }
    
        // Remove duplicate meeting IDs by using array_unique
        $meetingIds = array_unique($meetingIds);

        // Paginate the meetingIds array (let's say 10 items per page)
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = array_slice($meetingIds, $currentPage * $perPage - $perPage, $perPage);
        $meetingIdsPaginator = new LengthAwarePaginator($currentItems, count($meetingIds), $perPage, $currentPage);

        // Fetch meeting details for each meeting ID
        $meetingDetails = [];

        foreach ($meetingIdsPaginator as $meetingId) {
            $meetingDetails[] = Zoom::getMeeting($meetingId);
        }

        // Return the view with the meeting IDs if found
        return view('auth.student.live-classes', compact('meetingDetails', 'meetingIdsPaginator'));
    }

    public function recordedClass() {
        // Retrieve the student record based on the logged-in student's username
        $studentRecord = Student::where('student_id', Auth::user()->username)->first();
    
        // Decode the course_id stored as JSON
        $course = json_decode($studentRecord->course_id);
    
        $classes = [];
    
        // Loop through each course ID and fetch the course details
        foreach($course as $id) {
            // Encrypt the course ID before storing it in the array
            $encryptedId = Crypt::encrypt($id);
            $courseData = Course::find($id);
            
            if ($courseData) {
                $classes[] = [
                    'course' => $courseData,  // Store course object, not array
                    'encrypted_id' => $encryptedId, // Store the encrypted ID
                ];
            }
        }

        // Return the view with the classes and their encrypted IDs
        return view('auth.student.recorded-classes', compact('classes'));
    }
    
    public function viewRecordedClass($id)
    {
        $class_id = Crypt::decrypt($id);
    
        if (!$class_id) {
            return redirect()->back()->with('warning', "Classes Not Found");
        }
    
        $class = Course::join('recorded_courses', 'courses.id', '=', 'recorded_courses.course_id')
            ->select(
                'courses.*', 'recorded_courses.comments',
                'recorded_courses.level', 'recorded_courses.thumbnail',
                'recorded_courses.intro_video_path', 'recorded_courses.duration',
                'recorded_courses.video_quality'
            )
            ->where('courses.id', $class_id)
            ->first();
    
        // Get all course curriculum details by course ID and join with comments based on section_number and chapter_number
        $courseMaterialDetails = CourseCurriculum::leftJoin('class_comments', function($join) {
            $join->on('course_curriculum.chapter_number', '=', 'class_comments.chapter_number')
                 ->on('course_curriculum.section_number', '=', 'class_comments.section_number');
        })
        ->select(
            'course_curriculum.*',
            'class_comments.comment',
            'class_comments.student_name',
            'class_comments.created_at as comment_created_date'
        )
        ->where('course_curriculum.course_id', $class_id)
        ->get();
    
        // Group the chapters by section number
        $groupedChapters = $courseMaterialDetails->groupBy('section_number');
    
        // Now, you need to format the comments for each chapter to group them as an array of comments
        $groupedChapters = $groupedChapters->map(function ($chapters) {
            return $chapters->groupBy('chapter_number')->map(function ($chapterGroup) {
                $chapter = $chapterGroup->first(); // Assuming the first record in the group is the main chapter record
                $comments = $chapterGroup->map(function ($comment) {
                    return [
                        'student_name' => $comment->student_name,
                        'comment' => $comment->comment,
                        'comment_created_date' => $comment->comment_created_date
                    ];
                })->toArray();
    
                $chapter->comments = $comments;
                return $chapter;
            });
        });
    
        return view('auth.student.view-recorded-class', compact('class', 'groupedChapters'));
    }
    

    public function addComments(Request $request){

        try {
            DB::beginTransaction();

            $commentData = [
                'student_id' => Auth::user()->username,
                'student_name' => Auth::user()->name,
                'section_number' => $request->section_id,
                'chapter_number' => $request->chapter_id,
                'comment' => $request->comment_text,
            ];

           $response = ClassComment::create($commentData);

            DB::commit();
            return redirect()->back()->with('success', "Comment Added Successfully");

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function quiz(){
        return view('auth.student.quiz');
    }

    public function dailySadhnaReport(){
        $reports = SadhanaReport::where('student_id', Auth::user()->username)->get(); //
        return view('auth.student.daily-sadhana-report', compact('reports'));
    }

    public function storeDailySadhanaReport(Request $request){

        try {
            DB::beginTransaction();

            $sadhanaData = [
               'student_id' => Auth::user()->username,
               'wake_up_time' => $request->wake_up_time,
               'mangla_arti' => $request->mangla_arti,
               'chanting_round_before_9_am' => $request->chanting_round_before_9_am,
               'chanting_round_between_9_am_to_9_pm' => $request->chanting_round_between_9_am_to_9_pm,
               'chanting_round_after_9_pm' => $request->chanting_round_after_9_pm,
               'hearing_duration_hour' => $request->hearing_duration_hour,
               'hearing_duration_minute' => $request->hearing_duration_minute,
               'reading_duration_hour' => $request->reading_duration_hour,
               'reading_duration_minute' => $request->reading_duration_minute,
               'sleeping_time' => $request->sleeping_time,
            ];

            SadhanaReport::create($sadhanaData);

            DB::commit();
            return redirect()->back()->with('success', "Daily Sadhana Report Saved Successfully");

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
