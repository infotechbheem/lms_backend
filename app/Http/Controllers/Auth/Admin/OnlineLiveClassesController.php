<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Membership;
use App\Models\PhysicalClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jubaer\Zoom\Facades\Zoom;

class OnlineLiveClassesController extends Controller
{
    public function createLiveWorkShop()
    {
        return view('auth.admin.online-live-classes.create-live-workshop');
    }

    public function createMeeting(Request $request)
    {
        try {
            $meetings = Zoom::createMeeting([
                "agenda" => $request->agenda,
                "topic" => $request->topic,
                "type" => 2, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
                "duration" => (int)$request->duration, // in minutes
                "timezone" => $request->timezone, // set your timezone
                // Ensure the start_time is in correct ISO 8601 format
                "password" => $request->password, // set your password
                "start_time" => $request->start_time, // Use your time zone offset here (Asia/Kolkata is +05:30)
                "pre_schedule" => false, // set true if you want to create a pre-scheduled meeting
                "schedule_for" => $request->schedule_for, // Ensure this is a valid Zoom user email
                "settings" => [
                    'join_before_host' => true, // allow participants to join before the host
                    'host_video' => true, // start video when host joins
                    'participant_video' => true, // start video when participants join
                    'mute_upon_entry' => true, // mute participants when they join the meeting
                    'waiting_room' => true, // use a waiting room for participants
                    'audio' => 'both', // values are 'both', 'telephony', 'voip'. Default is both.
                    'auto_recording' => 'cloud', // start recording automatically, choose from 'none', 'local', 'cloud'.
                    'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
                ],
            ]);

            if ($meetings['status']) {
                return redirect()->back()->with('success', "Meeting created successfully!!");
            }
            return redirect()->back()->with("error", "Internal Server Error");
        } catch (\Exception $e) {
            // Capture and display the full error message
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function createdMeetings()
    {
        $allMeetings = Zoom::getAllMeeting();
        $data = $allMeetings['data'];
        $meetings = $data['meetings'];

        $courses = PhysicalClass::all();
        $memberships = Membership::all();
        $students = Student::all();


        return view('auth.admin.online-live-classes.meeting', compact('meetings', 'memberships', 'courses', 'students'));
    }

    public function mettingDetails($meetingId)
    {
        $meeting = Zoom::getMeeting($meetingId);

        $meetingLinksDetails = DB::table('meeting_links_shows')->where('meeting_id', $meetingId)->first();
        $studentMeetingsLinks = json_decode($meetingLinksDetails->student_id, true);
        $membershipMeetingsLinks = json_decode($meetingLinksDetails->membership_id, true);
        $courseMeetingsLinks = json_decode($meetingLinksDetails->course_id, true);

        if ($meeting) {
            $data = $meeting['data'];
            // dd($data);
            return view('auth.admin.online-live-classes.view-meeting-details', compact('data', 'studentMeetingsLinks', 'membershipMeetingsLinks', 'courseMeetingsLinks'));
        }
        return redirect()->back()->with('error', 'Meeting not found');
    }


    public function deleteMeetings($meetingId)
    {
        $meeting = Zoom::deleteMeeting($meetingId);

        if ($meeting) {
            return redirect()->back()->with('success', 'Meeting deleted successfully');
        }
        return redirect()->back()->with('error', 'Meeting deletion failed');
    }


    public function sendMeetingsLinks(Request $request){
        try {

            DB::beginTransaction();

            $data = [
                'meeting_id' => $request->meeting_id,
                'course_id' => json_encode( $request->course),
                'membership_id' => json_encode( $request->membership),
                'student_id' => json_encode( $request->student),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $response = DB::table('meeting_links_shows')->insert($data);
            if($response){
                DB::commit();
                return redirect()->back()->with('success', 'Meeting links sent successfully');
            }   
            DB::rollBack();
            return redirect()->back()->with('error', 'Meeting links sending failed');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }   
    }

    public function oneToOneSession(){
        return view('auth.admin.online-live-classes.one-to-one-session');
    }
}
