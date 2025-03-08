<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CredentialController extends Controller
{
    public function generateMembershipId()
    {
        // Prefix for the membership ID
        $prefix = "MEM";

        // Get the current timestamp
        $timestamp = time();  // Unix timestamp (e.g., 1676177100)

        // Generate a random 4-digit number
        $randomNumber = rand(1000, 9999);  // Random number between 1000 and 9999

        // Combine prefix, timestamp, and random number
        $membershipId = $prefix . $timestamp . $randomNumber;

        return $membershipId;
    }

    public function generateStudentId()
    {
        // Get the current year
        $currentYear = date('y');

        // Generate a unique random number for the ID
        $uniqueNumber = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

        // Combine them to form the student_id
        $studentId = $currentYear . '-' . $uniqueNumber;

        return $studentId;
    }

    public function generatePassword()
    {
        // Using Laravel's built-in helper function (Laravel 6+)
        $password = Str::random(12);  // Generates a random string of 12 characters (default length)

        return $password;
    }
}
