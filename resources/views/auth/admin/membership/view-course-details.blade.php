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
                                <div class="col-12 col-md-4 col-lg-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Level</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->level }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Q & A Access</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->question_answer_access }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Comments</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->comments }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Duration</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->duration }} Min.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Video Quality</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->video_quality }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Uploaded Date</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $recordedCourse->upload_date }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3 shadow-lg">
                                <div class="col-md-6 col-lg-6">
                                    <h4>Intro Video</h4>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ asset($recordedCourse->intro_video_path) }}" allowfullscreen></iframe>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <h4>Thumbnail</h4>
                                    @if($recordedCourse->thumbnail)
                                    <img src="{{ asset($recordedCourse->thumbnail) }}" alt="Thumbnail" class="img-fluid">
                                    @else
                                    <p>No thumbnail available</p>
                                    @endif
                                </div>
                            </div>

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
                                        <p class="m-0">
                                            <a href="{{ asset($chapter->pdf_material) }}" target="_blank" class="link-black text-sm">
                                                <i class="fas fa-link mr-1"></i> PDF Material
                                            </a>
                                        </p>
                                        @endif

                                        <!-- Display Video Material if exists -->
                                        @if($chapter->video_material)
                                        <p class="m-0">
                                            <a href="{{ asset($chapter->video_material) }}" target="_blank" class="link-black text-sm">
                                                <i class="fas fa-link mr-1"></i> Video Material
                                            </a>
                                        </p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ $courseDetails->course_title }}</h3>
                            <p class="text-muted">{{ $courseDetails->description }}</p>
                            <br>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Class title :
                                        <b class="d-block">{{ str()->ucfirst($courseDetails->class_title) }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Class Type :
                                        <b class="d-block">{{ str()->ucfirst($courseDetails->class_type) }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Start Date :
                                        <b class="d-block">{{ $courseDetails->start_date }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">End Date :
                                        <b class="d-block">{{ $courseDetails->end_date ?? "N/A" }}</b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Timing :
                                        <b class="d-block">{{ \Carbon\Carbon::parse($courseDetails->time)->format('h:i:A') ?? "N/A" }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Class Venue :
                                        <b class="d-block">{{ $courseDetails->venue }} </b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Fee Type :
                                        <b class="d-block">{{ $courseDetails->fee_type }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Currency :
                                        <b class="d-block">{{ $courseDetails->currency ?? "N/A" }}</b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Discount Price :
                                        <b class="d-block">₹ {{ number_format($courseDetails->discount_price, 2) ?? "N/A" }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="text-muted row">
                                <div class="col">
                                    <p class="text-sm">Cordinator Name :
                                        <b class="d-block">{{ str()->ucfirst($courseDetails->coordinator) }} </b>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="text-sm">Course Created Date & Timing :
                                        <b class="d-block">{{ \Carbon\Carbon::parse($courseDetails->created_at)->format('d-m-Y h:i:A') ?? "N/A" }}</b>
                                    </p>
                                </div>
                            </div>

                            <h5 class="mt-5 text-muted">Cover Image</h5>
                            <div class="row">
                                <img src="{{ asset('storage/'. $courseDetails->cover_image) }}" class="img-fluid" alt="">
                            </div>
                            <div class="text-center mt-5 mb-3">
                                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                            </div>
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
