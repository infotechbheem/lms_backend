<?php

use App\Models\Course;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Support\Str;

function formatDateAndTime($created_at){
    $formatedDate = Carbon::parse($created_at)->format('d-m-Y h:i:A');
    return $formatedDate;
}

function formatDate($date){
    $date = Carbon::parse($date)->format('d-m-Y');
    return $date;
}

function formatTime($time){
    $time = Carbon::parse($time)->format('h:i A');
    return $time;
}

function fullName($first_name, $last_name){
    $fulNmae = $first_name . ' ' . $last_name;
    return $fulNmae;
}

function upperCase($word){
    $upperCase = Str::ucfirst($word);
    return $upperCase;
}

function showImage($image_path){
    // Assuming you're using the 'public' disk for images
    return asset('storage/' . $image_path);
}

function getNumberOfCourse($data){
    $noOfCourses = count(json_decode($data));
    return $noOfCourses;
    
}
function getNumberOfMemberhsip($data){
    $noOfMemberhsips = count(json_decode($data));
   return $noOfMemberhsips;
}

function getCourseName($course_id){
    // Decode the course_id JSON into an array
    $courseId = json_decode($course_id);
    
    // Retrieve the courses with the given IDs
    $CourseNames = Course::whereIn('id', $courseId)->get();
    
    // Get all course titles and join them into a string separated by commas
    $courseTitles = $CourseNames->pluck('course_title')->implode(', ');
    
    // Return the concatenated course names
    return $courseTitles;
}
function getMembership($memberhsip_id){
    // Decode the memberhsip_id JSON into an array
    $membership_id = json_decode($memberhsip_id);
    
    // Retrieve the courses with the given IDs
    $CourseNames = Membership::whereIn('membership_id', $membership_id)->get();
    
    // Get all course titles and join them into a string separated by commas
    $memberjsip_name = $CourseNames->pluck('membership_name')->implode(', ');
    
    // Return the concatenated course names
    return $memberjsip_name;
}


