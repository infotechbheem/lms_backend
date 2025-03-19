@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin-asset/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Question Answering</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center" style="gap: 30px">
                <div class="col-md-5 bg-primary p-4">
                    <h3 class="m-0 text-white text-center mb-3">Asked Question Details</h3>
                    <div class="col-md-12">
                        <p><strong>Student Id : </strong> {{ $question->student_id }}</p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Student Name : </strong> {{ getStudentName($question->student_id) }}</p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Course : </strong> {{ getSingleCourseName($question->course_id) }}</p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Status : </strong> <span class="badge rounded-pill bg-{{ $question->status ? "success" : "warning" }}">{{ $question->status ? "Responsed" : "Asked" }}</span>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Question : </strong> {{ $question->questions ?? "Not Available" }}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Attachments :</strong>
                            @php
                            $attachments = getQuestionAnswerAttachments($question->question_with_attachment);
                            @endphp
                            @if ($attachments && count($attachments) > 0)
                            @foreach ($attachments as $index => $file)
                            <a class="text-white" href="{{ $file }}" target="_blank">Document {{ $index + 1 . ',' }}</a>
                            @endforeach
                            @else
                            <p class="text-white">No attachments available.</p>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Asked Date & Time : </strong>{{ formatDateAndTime($question->created_at) }}</p>
                    </div>
                </div>
                <div class="col-md-5 bg-primary p-4">
                    <h3 class="m-0 text-white text-center mb-3">Reply Question Answer Details</h3>
                    <div class="col-md-12">
                        <p><strong>Student Id : </strong> {{ $question->student_id }}</p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Student Name : </strong> {{ getStudentName($question->student_id) }}</p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Student Name : </strong> {{ getSingleCourseName($question->course_id) }}</p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Status : </strong> <span class="badge rounded-pill bg-{{ $question->status ? "success" : "warning" }}">{{ $question->status ? "Responsed" : "Asked" }}</span>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Answer : </strong> {!! $question->answer !!}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Attachments :</strong>
                            @php
                            $attachments = getQuestionAnswerAttachments($question->answer_with_attachment);
                            @endphp
                            @if ($attachments && count($attachments) > 0)
                            @foreach ($attachments as $index => $file)
                            <a class="text-white" href="{{ $file }}" target="_blank">Document {{ $index + 1 . ',' }}</a>
                            @endforeach
                            @else
                            <p class="text-white">No attachments available.</p>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Response Date & Time : </strong>{{ formatDateAndTime($question->updated_at) }}</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4 pt-4">
                <div class="col-md-8">
                    <div class="card card-warning">
                        <div class="card-header">Give Answer To The Question</div>
                        <form action="{{ route('admin.submit-question-answering-response') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="course_id" value="{{ $question->course_id }}">
                            <input type="hidden" name="id" value="{{ $question->id }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea id="compose-textarea" class="summernote" name="response"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="btn btn-default btn-file">
                                        <i class="fas fa-paperclip"></i> Attachment
                                        <input type="file" name="attachment[]" multiple title="You can attached multiple file">
                                    </div>
                                    <p class="help-block">Max. 32MB</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button style="float: right" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Summernote -->
<script src="{{ asset('admin-asset/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    // Initialize Summernote with custom height
    $(document).ready(function() {
        $('#compose-textarea').summernote({
            height: 300, // Set the height of the Summernote editor
            placeholder: 'Write your answer here...', // Optional: Add placeholder text
            tabsize: 2, // Optional: Tab size in the editor
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']]
                , ['font', ['strikethrough', 'superscript', 'subscript']]
                , ['fontname', ['fontname']]
                , ['para', ['ul', 'ol', 'paragraph']]
                , ['insert', ['link', 'picture', 'video']]
                , ['view', ['fullscreen', 'codeview', 'help']]
            , ]
        });
    });

</script>



@endsection
