<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

function formatDateAndTime($created_at){
    $formatedDate = Carbon::prase($created_at)->format('d-m-Y h:i:A');
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
