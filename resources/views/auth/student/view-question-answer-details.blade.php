@extends('auth.student.layouts.app')

@section('main-section')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-gradient-primary">
                <div class="card-body">
                    <div class="card-title text-center text-white">Your Question</div>
                    <div class="col-4">
                        <p class="text-white"><strong>Course Name :</strong> {{ getSingleCourseName($questionAnswer->course_id) }}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Question :</strong> {{ $questionAnswer->questions }}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Attachments :</strong>
                            @php
                            $attachments = getQuestionAnswerAttachments($questionAnswer->question_with_attachment);
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
                        <p class="text-white"><strong>Status :</strong> {{ $questionAnswer->status ?  "Replied" : "Asked" }}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Ask Timing :</strong> {{ formatDateAndTime($questionAnswer->created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-gradient-warning">
                <div class="card-body">
                    <div class="card-title text-center">Reply From the Admin</div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Course Name :</strong> {{ getSingleCourseName($questionAnswer->course_id) }}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Answer :</strong> {!! $questionAnswer->answer !!}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-white"><strong>Attachments :</strong>
                            @php
                            $attachments = getQuestionAnswerAttachments($questionAnswer->answer_with_attachment);
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
                        <p class="text-white"><strong>Response Timing :</strong> {{ formatDateAndTime($questionAnswer->updated_at) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
