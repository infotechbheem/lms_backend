@extends('auth.admin.layouts.app')

@section('main-content')

<!-- Summernote Styles -->
<link rel="stylesheet" href="{{ asset('admin-asset/plugins/summernote/summernote-bs4.min.css') }}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header py-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Assignment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assignments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0">Create Assignment</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store-assignment') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Course Selection and Assignment Title Section -->
                        <div class="row mb-4">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="course">Select Course</label>
                                    <select name="course_id" id="course" class="form-control" required>
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                        <option value="{{$course->id }}">{{ $course->course_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="assignment_title">Assignment Title</label>
                                    <input type="text" class="form-control" id="assignment_title" name="assignment_title" placeholder="Enter Assignment Title" required>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="passing_percentage">Passing Percentage</label>
                                    <input type="number" class="form-control" id="passing_percentage" name="passing_percentage" placeholder="Enter Passing Percentage" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="retake_allowed">How many times retake allowed?</label>
                                    <input type="number" class="form-control" id="retake_allowed" name="retake_allowed" placeholder="Retake Allowed" required>
                                </div>
                            </div>
                        </div>

                        <!-- Add Question Button -->
                        <div class="row mb-4">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-primary" id="addQuestionBtn">
                                    <i class="fas fa-plus-circle"></i> Add Question
                                </button>
                            </div>
                        </div>

                        <!-- Dynamic Questions Section -->
                        <div id="questionsSection" class="bordered">
                            <!-- Questions will be added here dynamically -->
                        </div>

                        <!-- Submit Assignment Form -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="fas fa-save"></i> Save Assignment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin-asset/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        let questionCount = 0;

        // Function to add question section dynamically
        $('#addQuestionBtn').click(function() {
            questionCount++;

            let questionHtml = `
            <div class="row mb-3 border p-4 rounded" id="question_${questionCount}">
                <div class="col-md-1 col-sm-2 col-12 text-center">
                    <div class="form-group">
                        <label class="font-weight-bold text-info">Question ${questionCount}</label>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="question_type_${questionCount}">Question Type</label>
                        <select name="questions[${questionCount}][question_type]" id="question_type_${questionCount}" class="form-control question-type" required>
                            <option value="MCQ">MCQ</option>
                            <option value="TrueFalse">True/False</option>
                            <option value="Subjective">Subjective</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="question_${questionCount}">Question</label>
                        <input type="text" class="form-control" id="question_${questionCount}" name="questions[${questionCount}][question_text]" placeholder="Enter Question" required>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="required_${questionCount}">Is this question required?</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="required_${questionCount}" name="questions[${questionCount}][is_required]" value="1">
                            <label class="custom-control-label" for="required_${questionCount}">Yes</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="question_details_${questionCount}" class="question-details">
                <!-- Additional inputs will appear here depending on question type -->
            </div>
            <hr class="my-4 bg-dark" style="height:2px; border-radius:3px;"> <!-- This HR tag separates the questions -->
        `;

            $('#questionsSection').append(questionHtml);

            // Event listener for changing question type
            $(`#question_type_${questionCount}`).change(function() {
                let questionType = $(this).val();
                handleQuestionTypeChange(questionCount, questionType);
            });

            // Initially trigger to load the correct fields for MCQ
            handleQuestionTypeChange(questionCount, 'MCQ');
        });

        // Function to handle the display of options/fields based on question type
        function handleQuestionTypeChange(questionId, questionType) {
            const questionDetails = $(`#question_details_${questionId}`);

            questionDetails.empty();

            if (questionType === 'MCQ') {
                questionDetails.append(`
                <div class="form-group">
                    <label for="options_${questionId}">Answer Options (separate with commas)</label>
                    <input type="text" class="form-control" id="options_${questionId}" name="questions[${questionId}][options]" placeholder="e.g., Option 1, Option 2, Option 3" required>
                </div>
            `);
            } else if (questionType === 'TrueFalse') {
                questionDetails.append(`
                <div class="form-group">
                    <label for="correct_answer_${questionId}">Correct Answer</label>
                    <select class="form-control" id="correct_answer_${questionId}" name="questions[${questionId}][correct_answer]" required>
                        <option value="True">True</option>
                        <option value="False">False</option>
                    </select>
                </div>
            `);
            } else if (questionType === 'Subjective') {
                questionDetails.append(`
                <div class="form-group">
                    <label for="answer_description_${questionId}">Answer Description</label>
                    <textarea class="form-control summernote" id="answer_description_${questionId}" name="questions[${questionId}][answer_description]" placeholder="Enter Answer Description"></textarea>
                </div>
            `);

                // Initialize Summernote for this specific textarea
                $('#answer_description_' + questionId).summernote({
                    height: 150, // Adjust the height of the editor
                    placeholder: 'Enter your answer description here...'
                });
            }
        }
    });

</script>

@endsection
