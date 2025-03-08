<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Auth\CredentialController;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Course;
use App\Models\CourseCurriculum;
use App\Models\Membership;
use App\Models\RecordedCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{

    public function createMembership()
    {
        $courses =  Course::all();
        return view('auth.admin.membership.create-membership', compact('courses'));
    }

    public function storeMembership(Request $request)
    {
        try {
            DB::beginTransaction();

            // Generate Membership ID
            $credential = new CredentialController();
            $membershipId = $credential->generateMembershipId();

            // Prepare data for insertion
            $data = [
                'membership_id' => $membershipId,
                'membership_name' => $request->membership_name,
                'plan' => $request->plan,
                'currency' => $request->currency,
                'description' => $request->description,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'status' => true,
                
            ];

            // dd($data);

            if ($request->hasFile('cover_image')) {
                // Get the file and store it on the public disk
                $coverImage = $request->file('cover_image');
                $coverImagePath = $coverImage->store('membership_cover_images', 'public'); // Store in storage/app/public/membership_cover_images

                // Add the image path to the data array
                $data['cover_image'] = $coverImagePath;
            }


            // Store membership data in the database
            $membershipResponse = Membership::create($data);

            if ($membershipResponse) {
                DB::commit();
                return redirect()->back()->with('success', 'Membership created successfully.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function allMemberships()
    {
        $memberships = Membership::all();
        return view('auth.admin.membership.all-membership', compact('memberships'));
    }
    public function deleteMembership($id)
    {
        // Find the membership by ID
        $membership = Membership::find($id);

        // Check if the membership exists
        if ($membership) {
            // Get the path of the cover image
            $coverImagePath = $membership->cover_image;

            // Attempt to delete the membership
            $deleted = $membership->delete();

            // If membership is deleted, check and delete the cover image file
            if ($deleted) {
                // Delete the image file if it exists
                if ($coverImagePath && Storage::exists($coverImagePath)) {
                    Storage::delete($coverImagePath);
                }

                return redirect()->back()->with('success', 'Membership and cover image deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete membership.');
            }
        } else {
            return redirect()->back()->with('error', 'Membership not found.');
        }
    }

    public function createCourse(){
        $memberships = Membership::all();
        return view('auth.admin.membership.create-course', compact('memberships'));
    }


    public function storeCourse(Request $request)
    {
        try {
            DB::beginTransaction();

            $offlineData = [
                'course_title' => $request->course_title,
                'class_title' => $request->class_title,
                'class_type' => $request->class_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'time' => $request->time,
                'venue' => $request->venue,
                'coordinator' => $request->coordinator,
                'fee_type' => $request->fee_type,
                'currency' => $request->currency,
                'discount_price' => $request->discount_price,
                'description' => $request->descriptions,
                'membership_id' => $request->membership,
            ];

            if ($request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                $offlineData['cover_image'] = $file->store('course/cover-image', 'public');
            }

            $dbResponse = Course::create($offlineData);
            if ($dbResponse) {
                DB::commit();
                return redirect()->back()->with('success', 'Offline Class created successfully');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function createdCourse()
    {
        $courses = Course::all();
        // Encrypt the course ID before passing to the view
        $courses = $courses->map(function($course) {
            $course->encrypted_id = Crypt::encryptString($course->id);
            return $course;
        });
        return view('auth.admin.membership.created-courses', compact('courses'));
    }

    public function deleteCourse($course_id){
        $dbCourse = Course::find($course_id);
        $dbCourse->delete();
        return redirect()->back()->with('success','Course deleted successfully');
    }

    public function studentChangeStatus($id)
    {
        // Fetch the user by username
        $changeStatus = User::where('username', $id)->first();

        // Check if user exists
        if ($changeStatus) {
            // Toggle the status
            $newChangeStatus = $changeStatus->status ? false : true;

            // Update the status field in the database
            $statusChange = User::where('username', $id)->update(['status' => $newChangeStatus]);

            // Check if the status was successfully updated
            if ($statusChange) {
                return redirect()->back()->with('success', 'Status changed successfully');
            } else {
                return redirect()->back()->with('failed', 'Failed to change the status');
            }
        }

        // If user not found
        return redirect()->back()->with('failed', 'User not found');
    }

    public function viewCourseDetails($Course_id){
        // Decrypt the course ID
        $materialId = Crypt::decryptString($Course_id);
    
        // Get all course curriculum details by course ID
        $courseMaterialDetails = CourseCurriculum::where('course_id', $materialId)->get();
    
        // Get the course details
        $courseDetails = Course::find($materialId);
    
        // Get the recorded course (for intro video, etc.)
        $recordedCourse = RecordedCourse::where('course_id', $materialId)->first();
    
        // If any of the details are missing, redirect back with an error
        if(!$courseMaterialDetails || !$courseDetails || !$recordedCourse){
            return redirect()->back()->with('error', 'Material courses not found');
        }
    
        // Group the chapters by section number
        $groupedChapters = $courseMaterialDetails->groupBy('section_number');
        
        // Return the view with the required data
        return view('auth.admin.membership.view-course-details', compact('groupedChapters', 'courseDetails', 'recordedCourse'));
    }
}
