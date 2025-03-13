@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Course Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Course Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Course Detail</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Level</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->level }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Q & A Access</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->question_answer_access }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Comments</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->comments }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Duration</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->duration }} Min.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Video Quality</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->video_quality }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Uploaded Date</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->upload_date }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4>Intro Video</h4>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ asset($recordedCourse->intro_video_path) }}" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ $course->course_title }}</h3>
                            <p class="text-muted">{{ $course->description }}</p>
                            <br>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Class title :
                                        <b class="d-block">{{ str()->ucfirst($course->class_title) }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Class Type :
                                        <b class="d-block">{{ str()->ucfirst($course->class_type) }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Start Date :
                                        <b class="d-block">{{ $course->start_date }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">End Date :
                                        <b class="d-block">{{ $course->end_date ?? "N/A" }}</b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Timing :
                                        <b class="d-block">{{ \Carbon\Carbon::parse($course->time)->format('h:i:A') ?? "N/A" }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Class Venue :
                                        <b class="d-block">{{ $course->venue }} </b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Fee Type :
                                        <b class="d-block">{{ $course->fee_type }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Currency :
                                        <b class="d-block">{{ $course->currency ?? "N/A" }}</b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Discount Price :
                                        <b class="d-block">₹ {{ number_format($course->discount_price, 2) ?? "N/A" }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Cordinator Name :
                                        <b class="d-block">{{ str()->ucfirst($course->coordinator) }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Course Created Date & Timing :
                                        <b class="d-block">{{ \Carbon\Carbon::parse($course->created_at)->format('d-m-Y h:i:A') ?? "N/A" }}</b>
                                    </p>
                                </div>
                            </div>

                            <h5 class="mt-5 text-muted">Cover Image</h5>
                            <div class="row">
                                <img src="{{ asset('storage/'. $course->cover_image) }}" class="img-fluid" alt="">
                            </div>

                        </div>

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
                                        <div class="user-block">
                                            <span style="float: left; border-radius: 50%; width:40px; height: 40px; color: #fff; background-color: magenta; display: flex; justify-content: center; align-items: center; font-weight: bold;"> CH {{ $chapter->chapter_number }}</span>
                                            <span class="username">
                                                <a href="#">{{ $chapter->chapter_name }}</a>
                                            </span>
                                            <span class="description">Created on: {{ \Carbon\Carbon::parse($chapter->created_at)->format('d M Y, h:i A') }}</span>
                                        </div>
                                        <!-- /.user-block -->

                                        <p>{!! $chapter->chapter_content !!}</p>

                                        <!-- Display PDF Material if exists -->
                                        @if($chapter->pdf_material)
                                        @php
                                        $pdfMaterials = json_decode($chapter->pdf_material);
                                        @endphp
                                        @foreach ($pdfMaterials as $pdf)
                                        <p class="m-0">
                                            <a href="{{ asset($pdf) }}" target="_blank" class="link-black text-sm">
                                                <i class="fas fa-link mr-1"></i> PDF Material
                                            </a>
                                        </p>
                                        @endforeach
                                        @endif

                                        <!-- Display Video Material if exists -->
                                        @if($chapter->video_material)
                                        @php
                                        $videoMaterials = json_decode($chapter->video_material);
                                        @endphp
                                        @foreach ($videoMaterials as $video)
                                        <p class="m-0">
                                            <a href="{{ asset($video) }}" target="_blank" class="link-black text-sm">
                                                <i class="fas fa-link mr-1"></i> Video Material
                                            </a>
                                        </p>
                                        @endforeach
                                        @endif

                                        <!-- Display Audio Material if exists -->
                                        @if($chapter->audio_materials)
                                        @php
                                        $audioMaterials = json_decode($chapter->audio_materials);
                                        @endphp
                                        @foreach ($audioMaterials as $audio)
                                        <p class="m-0">
                                            <a href="{{ asset($audio) }}" target="_blank" class="link-black text-sm">
                                                <i class="fas fa-link mr-1"></i> Audio Material
                                            </a>
                                        </p>
                                        @endforeach
                                        @endif

                                        <!-- Display Image Material if exists -->
                                        @if($chapter->image_materials)
                                        @php
                                        $imageMaterials = json_decode($chapter->image_materials);
                                        @endphp
                                        @foreach ($imageMaterials as $image)
                                        <p class="m-0">
                                            <a href="{{ asset($image) }}" target="_blank" class="link-black text-sm">
                                                <i class="fas fa-link mr-1"></i> Image Material
                                            </a>
                                        </p>
                                        @endforeach
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
</div>


<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>


@endsection
