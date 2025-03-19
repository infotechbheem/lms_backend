@extends('auth.student.layouts.app')

@section('main-section')

<style>
    .quill-editor {
        height: 150px;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        background-color: #fff;
    }

    .question-section {
        margin-top: 20px;
        padding: 20px;
        background: #f7f7f7;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .question-title {
        font-size: 18px;
        font-weight: bold;
    }

    .question-type {
        font-style: italic;
        color: #666;
    }

    .question-options {
        list-style-type: none;
        padding-left: 0;
    }

    .question-options li {
        padding: 5px 0;
    }

    .submit-btn {
        width: 100%;
        background-color: #007bff;
        color: white;
        padding: 10px;
        border: none;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }
</style>

<div class="content-wrapper">
    <div class="row">
        <!-- Assignment Details -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card bg-gradient-primary">
                <div class="card-body">
                    <h4 class="card-title text-center text-white">Do Assignments</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-white"><strong>Assignment Title: </strong>{{ $assignment->assignment_title }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-white"><strong>Passing Percentage: </strong>{{ $assignment->passing_percentage }}%</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-white"><strong>Retake Allowed: </strong>{{ $assignment->retake_allowed }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assignment Questions -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card bg-gradient-info">
                <div class="card-body">
                    <h4 class="card-title text-center text-white">Answer the Questions</h4>

                    <form id="assignmentForm" action="{{ route('student.submit-assignment', $assignment->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ auth()->user()->username }}"> <!-- Add student ID here -->
                        @foreach($assignment->questions as $key => $question)
                            <div class="question-section">
                                <div class="question-wrapper">
                                    <div class="question-title">
                                        {{ $key + 1 }}. {{ $question->question_text }}
                                        @if($question->is_required) <span style="color: red;">*</span> @endif
                                    </div>
                                    <div class="question-type">Type: {{ $question->question_type }}</div>

                                    @if($question->question_type == 'MCQ')
                                        <div class="question-options">
                                            @foreach($question->options as $option)
                                                <label class="d-block">
                                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->option_text }}" required>
                                                    {{ $option->option_text }}
                                                </label>
                                            @endforeach
                                        </div>

                                    @elseif($question->question_type == 'TrueFalse')
                                        <div class="question-options">
                                            <label class="d-block">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="True" required>
                                                True
                                            </label>
                                            <label class="d-block">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="False" required>
                                                False
                                            </label>
                                        </div>

                                    @elseif($question->question_type == 'Subjective')
                                        <div>
                                            {{-- <textarea  name="answers[{{ $question->id }}]" id=""></textarea> --}}
                                            <div id="editor-{{ $question->id }}" class="quill-editor"></div>
                                        </div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        @endforeach

                        <button type="submit" class="submit-btn">Submit Assignment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quill.js CDN -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    // Initialize Quill editor for subjective questions
    @foreach($assignment->questions as $question)
        @if($question->question_type == 'Subjective')
            var quill{{ $question->id }} = new Quill('#editor-{{ $question->id }}', {
                theme: 'snow',
                placeholder: 'Type your answer here...',
                modules: {
                    toolbar: [
                        [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['bold', 'italic', 'underline'],
                        [{ 'align': [] }],
                        ['link', 'image'],
                        [{ 'color': [] }, { 'background': [] }],
                        ['blockquote', 'code-block'],
                    ]
                }
            });

            // Automatically save the content to the form data on form submission
            $('form').submit(function() {
                // Get the content from the Quill editor
                var answerContent = quill{{ $question->id }}.root.innerHTML;
                // Add it to the form data
                $('<input>').attr({
                    type: 'hidden',
                    name: 'answers[{{ $question->id }}]',
                    value: answerContent
                }).appendTo('form');
            });
        @endif
    @endforeach

</script>

@endsection
