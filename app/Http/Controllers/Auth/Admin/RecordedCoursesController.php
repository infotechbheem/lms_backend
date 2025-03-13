<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCurriculum;
use App\Models\RecordedCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecordedCoursesController extends Controller
{
    public function addRecording(){
        $courses = Course::all();
        return view('auth.admin.recorded-course.add-recording', compact('courses'));
    }

    public function storeRecordedCourse(Request $request)
    {
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
    
                        // Handle multiple PDF files (store as JSON array)
                        $pdfFiles = [];
                        if ($request->hasFile("chapter_materials_{$sectionIndex}_{$chapterIndex}")) {
                            foreach ($request->file("chapter_materials_{$sectionIndex}_{$chapterIndex}") as $pdf) {
                                $pdfPath = $this->uploadFile($pdf, 'pdfs');
                                $pdfFiles[] = $pdfPath; // Add each uploaded PDF file path to the array
                            }
                        }
                        $pdfFilesJson = json_encode($pdfFiles); // Encode the array as JSON
        
                        // Handle multiple video files (store as JSON array)
                        $videoFiles = [];
                        if ($request->hasFile("chapter_video_materials_{$sectionIndex}_{$chapterIndex}")) {
                            foreach ($request->file("chapter_video_materials_{$sectionIndex}_{$chapterIndex}") as $video) {
                                $videoPath = $this->uploadFile($video, 'videos');
                                $videoFiles[] = $videoPath; // Add each uploaded video file path to the array
                            }
                        }
                        $videoFilesJson = json_encode($videoFiles); // Encode the array as JSON
        
                        // Handle multiple audio files (store as JSON array)
                        $audioFiles = [];
                        if ($request->hasFile("chapter_audio_materials_{$sectionIndex}_{$chapterIndex}")) {
                            foreach ($request->file("chapter_audio_materials_{$sectionIndex}_{$chapterIndex}") as $audio) {
                                $audioPath = $this->uploadFile($audio, 'audios');
                                $audioFiles[] = $audioPath; // Add each uploaded audio file path to the array
                            }
                        }
                        $audioFilesJson = json_encode($audioFiles); // Encode the array as JSON
        
                        // Handle multiple image files (store as JSON array)
                        $imageFiles = [];
                        if ($request->hasFile("chapter_image_materials_{$sectionIndex}_{$chapterIndex}")) {
                            foreach ($request->file("chapter_image_materials_{$sectionIndex}_{$chapterIndex}") as $image) {
                                $imagePath = $this->uploadFile($image, 'images');
                                $imageFiles[] = $imagePath; // Add each uploaded image file path to the array
                            }
                        }
                        $imageFilesJson = json_encode($imageFiles); // Encode the array as JSON
        
                        // Insert chapter related to this section
                        CourseCurriculum::create([
                            'course_id' => $request->course_id,
                            'section_number' => $sectionIndex,
                            'section_title' => $sectionTitle,
                            'chapter_number' => $chapterIndex,
                            'chapter_name' => $chapterTitle,
                            'chapter_content' => $chapterContent,
                            'pdf_material' => $pdfFilesJson, // Store PDFs as JSON
                            'video_material' => $videoFilesJson, // Store videos as JSON
                            'audio_material' => $audioFilesJson,  // Store audios as JSON
                            'image_material' => $imageFilesJson,  // Store images as JSON
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
            return back()->with('error', 'Failed to create recorded course: ' . $e->getMessage());
        }
    }
    

    private function uploadFile($file, $directory)
    {
        if ($file) {
            // Create a unique filename using current timestamp and original extension
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Ensure the directory exists, if not create it
            $path = $directory . '/' . date('Y/m/d');
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

            // Store the file in the public disk under the specified directory
            $file->storeAs($path, $filename, 'public');

            // Return the relative path to the file
            return "storage/$path/$filename";
        }
        return null;
    }

    
    public function addAssignment(){
        return view('auth.admin.recorded-course.add-assignments');
    }
}
