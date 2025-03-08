<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCurriculum;
use App\Models\RecordedCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordedCoursesController extends Controller
{
    public function addRecording(){
        $courses = Course::all();
        return view('auth.admin.recorded-course.add-recording', compact('courses'));
    }

    public function storeRecordedCourse(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
    
            // Insert into recorded_courses table
            $recordedCourse = RecordedCourse::create([
                'course_id' => $request->course_id,
                'question_answer_access' => $request->question_answer,
                'comments' => $request->comment_access,
                'level' => $request->level,
                'thumbnail' => $this->uploadFile($request->file('thumbnail'), 'thumbnails'),
                'intro_video_path' => $this->uploadFile($request->file('intro_video'), 'videos'),
                'duration' => $request->duration,
                'video_quality' => $request->video_quality,
                'upload_date' => $request->upload_date,
            ]);
    
            // Check if sections data is provided
            if ($request->has('section_title_1') && is_array($request->input())) {
                $sectionIndex = 1;
                
                while ($request->has("section_title_{$sectionIndex}")) {
                    $sectionTitle = $request->input("section_title_{$sectionIndex}");
    
                    // Debugging - Check if the request has chapters for the current section
                    $chapterIndex = 1;
                    while ($request->has("chapter_title_{$sectionIndex}_{$chapterIndex}")) {
                        // Fetch the chapter data from the request
                        $chapterTitle = $request->input("chapter_title_{$sectionIndex}_{$chapterIndex}");
                        $chapterContent = $request->input("chapter_content_{$sectionIndex}_{$chapterIndex}");
    
                  
                        // Handle file uploads
                        $chapterPdf = $this->uploadFile($request->file("chapter_materials_{$sectionIndex}_{$chapterIndex}"), 'pdfs');
                        $chapterVideo = $this->uploadFile($request->file("chapter_video_materials_{$sectionIndex}_{$chapterIndex}"), 'videos');
                       
                        // dd($chapterPdf);
                   
                        // Insert chapter related to this section
                        CourseCurriculum::create([
                            'course_id' => $request->course_id,
                            'section_number' => $sectionIndex,
                            'section_title' => $sectionTitle,
                            'chapter_number' => $chapterIndex,
                            'chapter_name' => $chapterTitle,
                            'chapter_content' => $chapterContent,
                            'pdf_material' => $chapterPdf,
                            'video_material' => $chapterVideo,
                        ]);
    
                        $chapterIndex++; // Increment chapter index
                    }
    
                    $sectionIndex++; // Increment section index
                }
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Recorded course created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback if error occurred during transaction
            dd($e);  // For debugging, remove this in production
            return back()->with('error', 'Failed to create recorded course: ' . $e->getMessage());
        }
    }
    
    private function uploadFile($file, $directory)
    {
        if ($file) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs("$directory", $filename, 'public');
            return "storage/$directory/$filename";
        }
        return null;
    }
    public function addAssignment(){
        return view('auth.admin.recorded-course.add-assignments');
    }
}
