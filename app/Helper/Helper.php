<?php

use App\Models\Course;
use App\Models\Membership;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Support\Str;

function formatDateAndTime($created_at)
{
    $formatedDate = Carbon::parse($created_at)->format('d-m-Y h:i:A');
    return $formatedDate;
}

function formatDate($date)
{
    $date = Carbon::parse($date)->format('d-m-Y');
    return $date;
}

function formatTime($time)
{
    $time = Carbon::parse($time)->format('h:i A');
    return $time;
}

function fullName($first_name, $last_name)
{
    $fulNmae = $first_name . ' ' . $last_name;
    return $fulNmae;
}

function upperCase($word)
{
    $upperCase = Str::ucfirst($word);
    return $upperCase;
}

function showImage($image_path)
{
    // Assuming you're using the 'public' disk for images
    return asset('storage/' . $image_path);
}

function getNumberOfCourse($data)
{
    $noOfCourses = count(json_decode($data));
    return $noOfCourses;

}
function getNumberOfMemberhsip($data)
{
    $noOfMemberhsips = count(json_decode($data));
    return $noOfMemberhsips;
}

function getSingleCourseName($course_id)
{
    // Retrieve the course with the given ID
    $course = Course::find($course_id);

    // Return the course title
    return $course->course_title;
}

function getCourseName($course_id)
{
    // Decode the course_id JSON into an array
    $courseId = json_decode($course_id);

    // Retrieve the courses with the given IDs
    $CourseNames = Course::whereIn('id', $courseId)->get();

    // Get all course titles and join them into a string separated by commas
    $courseTitles = $CourseNames->pluck('course_title')->implode(', ');

    // Return the concatenated course names
    return $courseTitles;
}
function getMembership($memberhsip_id)
{
    // Decode the memberhsip_id JSON into an array
    $membership_id = json_decode($memberhsip_id);

    // Retrieve the courses with the given IDs
    $CourseNames = Membership::whereIn('membership_id', $membership_id)->get();

    // Get all course titles and join them into a string separated by commas
    $memberjsip_name = $CourseNames->pluck('membership_name')->implode(', ');

    // Return the concatenated course names
    return $memberjsip_name;
}

function getQuestionAnswerAttachments($data)
{
    // Decode the data JSON into an array
    $attachments = json_decode($data, true);  // Ensure you decode to an array

    // Check if the attachment data is valid or empty
    if (empty($attachments)) {
        return [];  // Return an empty array if no attachments
    }

    // Loop through the attachments and get the file names
    $files = [];
    foreach ($attachments as $attachment) {
        $files[] = showImage($attachment);  // Assuming showImage() returns a full URL or path
    }

    return $files;  // Return the list of file paths
}

function getStudentName($student_id)
{
    // Retrieve the student with the given ID
    $student = Student::where('student_id', $student_id)->first(); //

    // Return the student full name
    return fullName($student->first_name, $student->last_name);
}

// For Only Student View Section 
function isMentor($student_id)
{
    $checkMentor = Mentor::where('mentor_id', $student_id)->exists(); //

    return $checkMentor ? "Yes" : "No";

}
function isVolunteer($student_id)
{
    $checkMentor = Volunteer::where('volunteer_id', $student_id)->exists(); //

    return $checkMentor ? "Yes" : "No";

}

function totalStudentRegistrationOverStudent($student_id)
{
    $totalRegistration = Student::where('created_by', $student_id)->count();
    return $totalRegistration;
}