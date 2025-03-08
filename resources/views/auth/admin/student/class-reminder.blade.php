@extends('auth.admin.layouts.app')

@section('main-content')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('admin-asset/plugins/summernote/summernote-bs4.min.css') }}">
<div class="content-wrapper">
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
                        <li class="breadcrumb-item active">Class Reminder</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    Class Reminder
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.send-class-reminder') }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 col-lg-3 col-sm-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Choose Student For Send Notification</h3>
                                    </div>
                                    <div class="card-body">
                                        @csrf
                                        <!-- Select Membership -->
                                        <div class="form-group">
                                            <label for="membership_id">Select Membership</label>
                                            <select id="membership_id" class="form-control">
                                                <option value="">Select Membership</option>
                                                @foreach ($memberships as $membership)
                                                <option value="{{ $membership->membership_id }}">{{ $membership->membership_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Select Course -->
                                        <div class="form-group">
                                            <label for="course_id">Select Course</label>
                                            <select id="course_id" class="form-control">
                                                <option value="">Select Course</option>
                                                @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <!-- Select Bulk or Individual Students -->
                                        <div class="form-group">
                                            <label for="select_bulk">Select Students</label>
                                            <select id="select_bulk" class="form-control">
                                                <option value="individual">Select Individual Students</option>
                                                <option value="bulk">Select All Students</option>
                                            </select>
                                        </div>

                                        <!-- List of Students -->
                                        <div class="form-group">
                                            <div class="row">
                                                @foreach ($students as $index => $student)
                                                <!-- Every two students per line -->
                                                @if ($index % 2 == 0 && $index != 0)
                                            </div>
                                            <div class="row">
                                                @endif
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="student_id[]" value="{{ $student->student_id }}" class="form-check-input student-checkbox" id="student_{{ $student->student_id }}">
                                                        <label class="form-check-label" for="student_{{ $student->student_id }}">
                                                            {{ $student->first_name . ' ' . $student->last_name }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-8 col-lg-9 col-sm-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Compose New Message</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <textarea id="compose-textarea" name="text-message" class="form-control" style="height: 300px">
                                                <h1><u>Heading Of Message</u></h1>
                                                <h4>Subheading</h4>
                                                <p>Here you can write your message</p>
                                                <ul>
                                                    <li>Here you add the item</li>
                                                    <li>Here you add the item</li>
                                                    <li>Here you add the item</li>
                                                    <li>Here you add the item</li>
                                                </ul>
                                                <p>Thank you,</p>
                                                <p>NetXperia Developer Team</p>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="btn btn-default btn-file">
                                                <i class="fas fa-paperclip"></i> Attachment
                                                <input type="file" name="attachment">
                                            </div>
                                            <p class="help-block">Max. 32MB</p>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="float-right">
                                            <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                                            <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                                        </div>
                                        <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                                    </div>
                                </div>
                            </div>
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
<!-- Page specific script -->
<script>
    $(function() {
        //Add text editor
        $('#compose-textarea').summernote()
    })

</script>
<script>
    $(document).ready(function() {

        // Handle the membership selection change
        $('#membership_id').change(function() {
            var membershipId = $(this).val();

            if (membershipId) {
                $.ajax({
                    url: "{{ route('get-student-by-membership') }}", // Ensure this route is defined
                    method: "GET"
                    , data: {
                        membership_id: membershipId
                    }
                    , success: function(response) {
                        // Uncheck all checkboxes first
                        $('.student-checkbox').prop('checked', false);

                        // Check the relevant students
                        response.students.forEach(function(student) {
                            $('#student_' + student.student_id).prop('checked', true);
                        });
                    }
                    , error: function() {
                        alert("Failed to fetch students.");
                    }
                });
            }
        });

        // Handle the course selection change
        $('#course_id').change(function() {
            var courseId = $(this).val();

            if (courseId) {
                $.ajax({
                    url: "{{ route('get-student-by-course') }}", // Ensure this route is defined
                    method: "GET"
                    , data: {
                        course_id: courseId
                    }
                    , success: function(response) {
                        // Uncheck all checkboxes first
                        $('.student-checkbox').prop('checked', false);

                        // Check the relevant students
                        response.students.forEach(function(student) {
                            $('#student_' + student.student_id).prop('checked', true);
                        });
                    }
                    , error: function() {
                        alert("Failed to fetch students.");
                    }
                });
            }
        });

        // Handle the select bulk option change (to select all or individual students)
        $('#select_bulk').change(function() {
            var selectedOption = $(this).val();

            if (selectedOption == 'bulk') {
                // Select all checkboxes when 'bulk' is chosen
                $('.student-checkbox').prop('checked', true);
            } else {
                // Deselect all checkboxes when 'individual' is chosen
                $('.student-checkbox').prop('checked', false);
            }
        });

    });

</script>

@endsection
