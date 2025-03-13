@extends('auth.student.layouts.app')

@section('main-section')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
<style>
    .post p a {
        text-decoration: none;
        color: rgb(93, 93, 93);
    }

</style>
<div class="content-wrapper">
    <div class="row">
        <!-- Courses Table -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-primary">
                <div class="card-body">
                    <div class="d-flex" style="justify-content: space-between">
                        <h4 class="card-title m-0 text-white">Course Title : {{ $class->course_title }} !!</h4>
                        <h4 class="card-title m-0 text-white">Class Title : {{ $class->class_title }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-primary">
                <div class="card-body d-flex" style="justify-content: center; align-items: center;">
                    <h4 class="card-title m-0 text-white">Level : {{ $class->level }} !!</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-success">
                <div class="card-body d-flex" style="justify-content: center; align-items: center;">
                    <h4 class="card-title m-0 text-white">Comments : {{ $class->comments }} !!</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-info">
                <div class="card-body d-flex" style="justify-content: center; align-items: center;">
                    <h4 class="card-title m-0 text-white">Duration : {{ $class->duration }} Min !!</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-warning">
                <div class="card-body d-flex" style="justify-content: center; align-items: center;">
                    <h4 class="card-title m-0 text-white">Video Quality : {{ $class->video_quality }} !!</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 grid-margin">
            <h4>Thumbnail</h4>
            <img src="{{ asset($class->thumbnail) }}" alt="thumbnail" style="height: 46vh; width: 100%;">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-12 grid-margin ">
            <h4>Intro Video</h4>
            <div class="embed-responsive embed-responsive-16by9" style="height: 46vh">
                <iframe class="embed-responsive-item" src="{{ asset($class->intro_video_path) }}" allowfullscreen style="height: 100% ; width: 100%;"></iframe>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 grid-margin">
            <h3 class="mt-3">Chapter View Details</h3>
            @foreach ($groupedChapters as $sectionNumber => $chapters)
            <div class="row mt-3 shadow-lg p-2 rounded" style="overflow: scroll">
                <div class="col-12">
                    <!-- Display section title -->
                    <h4>Section {{ $sectionNumber }}: {{ $chapters->first()->section_title }}</h4>

                    <!-- Loop through each chapter in the section -->
                    @foreach ($chapters as $chapter)
                    <div class="post">
                        <div class="user-block" style="display: flex; align-items: center;">
                            <span style="float: left; border-radius: 50%; width: 40px; height: 40px; color: #fff; margin-right: 10px; background-color: magenta; display: flex; justify-content: center; align-items: center; font-weight: bold;"> CH {{ $chapter->chapter_number }}</span>
                            <div class="div">
                                <span class="username">
                                    <a style="text-decoration: none; font-weight: 600;" href="#">{{ $chapter->chapter_name }}</a>
                                </span>
                                <br>
                                <span class="description" style="font-size: 14px; color: #5f5f5f;">Created on: {{ \Carbon\Carbon::parse($chapter->created_at)->format('d M Y, h:i A') }}</span>
                            </div>
                        </div>

                        <!-- Display Video Material if exists -->
                        @if($chapter->video_material)
                        @php
                        $videoMaterials = json_decode($chapter->video_material);
                        $videoCount = count($videoMaterials); // Count number of videos
                        @endphp
                        <div class="row mt-3">
                            <!-- Logic for video display based on the number of videos -->
                            @if($videoCount == 1)
                            <div class="col-12">
                                <div class="video-container" style="position: relative; padding-top: 56.25%; /* 16:9 Aspect Ratio */">
                                    <iframe src="{{ asset($videoMaterials[0]) }}" frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                </div>
                            </div>
                            @elseif($videoCount == 2)
                            @foreach ($videoMaterials as $video)
                            <div class="col-6">
                                <div class="video-container" style="position: relative; padding-top: 56.25%; /* 16:9 Aspect Ratio */">
                                    <iframe src="{{ asset($video) }}" frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                </div>
                            </div>
                            @endforeach
                            @elseif($videoCount >= 3)
                            @foreach ($videoMaterials as $index => $video)
                            @if($index == 0)
                            <div class="col-12">
                                <div class="video-container" style="position: relative; padding-top: 56.25%; /* 16:9 Aspect Ratio */">
                                    <iframe src="{{ asset($video) }}" frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                </div>
                            </div>
                            @else
                            <div class="col-6">
                                <div class="video-container" style="position: relative; padding-top: 56.25%; /* 16:9 Aspect Ratio */">
                                    <iframe src="{{ asset($video) }}" frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                        @endif

                        <p>{!! $chapter->chapter_content !!}</p>

                        <h5 class="mt-4">All Material :</h5>
                        <!-- Display PDF Material if exists -->
                        @if($chapter->pdf_material)
                        @php
                        $pdfMaterials = json_decode($chapter->pdf_material);
                        @endphp
                        <div class="row mt-3">
                            @foreach ($pdfMaterials as $pdf)
                            <div class="col-12">
                                <p class="m-2">
                                    <a href="{{ asset($pdf) }}" target="_blank" class="link-black text-sm">
                                        <i class="fas fa-link mr-1"></i> PDF Material
                                    </a>
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Display Audio Material if exists -->
                        @if($chapter->audio_materials)
                        @php
                        $audioMaterials = json_decode($chapter->audio_materials);
                        @endphp
                        <div class="row mt-3">
                            @foreach ($audioMaterials as $audio)
                            <div class="col-12">
                                <p class="m-2">
                                    <a href="{{ asset($audio) }}" target="_blank" class="link-black text-sm">
                                        <i class="fas fa-link mr-1"></i> Audio Material
                                    </a>
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Display Image Material if exists -->
                        @if($chapter->image_materials)
                        @php
                        $imageMaterials = json_decode($chapter->image_materials);
                        @endphp
                        <div class="row mt-3">
                            @foreach ($imageMaterials as $image)
                            <div class="col-12">
                                <p class="m-2">
                                    <a href="{{ asset($image) }}" target="_blank" class="link-black text-sm">
                                        <i class="fas fa-link mr-1"></i> Image Material
                                    </a>
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Comments Section -->
                        <div class="mt-4">
                            <h5>Top Comments:</h5>
                            <div class="comments-list" style="max-height: 300px; overflow-y: auto;">
                                @foreach($chapter->comments as $comment)
                                <div class="comment mb-3 p-3" style="background-color: #f8f9fa; border-radius: 5px; border-left: 5px solid #007bff;">
                                    <div class="user-info mb-2">
                                        <strong>{{ $comment['student_name'] }}</strong>
                                        <span style="font-size: 12px; color: #777;">on {{ \Carbon\Carbon::parse($comment['comment_created_date'])->format('d M Y, h:i A') }}</span>
                                    </div>
                                    <p>{{ $comment['comment'] }}</p>
                                </div>
                                @endforeach
                            </div>

                            <!-- Comment Form -->
                            <form action="{{ route('student.add-comments') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="section_id" value="{{ $sectionNumber }}">
                                <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">

                                <div class="form-group">
                                    <label for="comment_text">Add a comment</label>
                                    <textarea name="comment_text" id="comment_text" rows="4" class="form-control" placeholder="Write your comment here..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit Comment</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
