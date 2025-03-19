@extends('auth.admin.layouts.app')

@section('main-content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Course Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View Course Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="course-details-tab" data-toggle="pill" href="#course-details" role="tab" aria-controls="course-details-tab" aria-selected="false">Course Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="recorded-course-details-tab" data-toggle="pill" href="#recorded-course-details" role="tab" aria-controls="recorded-course-details-tab" aria-selected="true">Memberhsip Details</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="course-details" role="tabpanel" aria-labelledby="course-details-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered table-striped table-hover w-100">
                                        <tr>
                                            <th>Course Name</th>
                                            <td>{{ $course->course_title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ formatDate($course->start_date) }}</td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td>{{ formatDate($course->end_date) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Time</th>
                                            <td>{{ formatTime($course->time) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Cover Image</th>
                                            <td>
                                                <img src="{{ showImage( $course->cover_image) }}" alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Discount Price</th>
                                            <td>{{ number_format($course->discount_price,2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Membership Id</th>
                                            <td>{{ $course->membership_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $course->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ formatDateAndTime($course->created_at) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="recorded-course-details" role="tabpanel" aria-labelledby="recorded-course-details-tab">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Level</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->level ?? "Not Available" }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Q & A Access</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->question_answer_access ?? "Not Available"  }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Comments</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->comments ?? "Not Available"  }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Duration</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->duration ?? "Not Available"  }} Min.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Video Quality</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->video_quality ?? "Not Available"  }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Uploaded Date</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->upload_date ?? "Not Available"  }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="height: 35vh">
                                    <h4>Intro Video</h4>
                                    <div class="embed-responsive embed-responsive-16by9" style="height:100%">
                                        <iframe class="embed-responsive-item" style="height: 100%" src="{{ asset($recordedCourse->intro_video_path ?? "Not Available" ) }}" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-md-6" style="height: 35vh">
                                    <h4>Thumbnail</h4>
                                    <img src="{{ asset($recordedCourse->thumbnail ?? "Not Available" ) }}" alt="Course Details" style="height: 100%; width: 100%; object-fit: cover;">
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-2">
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

                                                    <h5>Top Comments: {{ number_format(count($chapter->comments),0) }}</h5>
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
                                                    <form action="{{ route('admin.store-comments') }}" method="POST" class="mt-4">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
