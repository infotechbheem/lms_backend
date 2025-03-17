@extends('auth.admin.layouts.app')

@section('main-content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance Department</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Attendance</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header" style="border: 1px solid green;">
                    <h5 class="m-0 p-0 text-left">Add Attendance</h5>
                </div>
                <div class="card-body">
                    <h2 class="text-center py-4" id="live-time"></h2>
                    <div class="row mb-4 justify-content-center">
                        <div class="col-md-4">
                            <label for="">Select Membership</label>
                            <select name="membership_id" id="membership_id" class="form-control">
                                <option value="">Select Membership</option>
                                @foreach ($memberships as $membership)
                                <option value="{{ $membership->membership_id }}">{{ $membership->membership_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="course">Course:</label>
                            <select name="course" id="course" class="form-control">
                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <form action="{{ route('admin.store-attendance') }}" id="mark_attendance" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Student Id</th>
                                            <th id="selected">Selected</th>
                                            <th>Attendance Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="students-list">
                                        <!-- Students will be populated dynamically here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-primary" style="float:right;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTime() {
            const now = new Date();
            const options = {
                day: 'numeric'
                , month: 'short'
                , year: 'numeric'
                , hour: '2-digit'
                , minute: '2-digit'
                , second: '2-digit'
                , hour12: false
            };
            document.getElementById('live-time').textContent = now.toLocaleString('en-GB', options);
        }

        // Update time immediately and then every second
        updateTime();
        setInterval(updateTime, 1000);
    });

    // Handle membership change
    $('#membership_id').change(function() {
        var membershipId = $(this).val();

        // Reset the students list and course selection
        $('#students-list').empty();
        $('#course').val('');

        if (membershipId) {
            $.ajax({
                url: "{{ route('get-student-by-membership') }}", // Ensure this route is defined in routes/web.php
                method: "GET"
                , data: {
                    membership_id: membershipId
                }
                , success: function(response) {
                    if (response.students.length > 0) {

                        $('#selected').text('Selected Membership');

                        response.students.forEach(function(student, index) {
                            $('#students-list').append(`
                                <tr>
                                    <td>
                                        <input type="text" name="attendances[${index}][student_name]" class="form-control" value="${student.first_name} ${student.last_name}" required readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="attendances[${index}][student_id]" class="form-control" value="${student.student_id}" required readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="attendances[${index}][membership]" class="form-control" value="${membershipId}" required readonly>
                                    </td>
                                   <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input present-checkbox" type="radio" id="present_${index}" name="attendances[${index}][attendance_status]" required value="present" />
                                            <label class="form-check-label" for="present_${index}">Present</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input absent-checkbox" type="radio" id="absent_${index}" name="attendances[${index}][attendance_status]" required value="absent" />
                                            <label class="form-check-label" for="absent_${index}">Absent</label>
                                        </div>
                                    </td>

                                </tr>
                            `);

                            // Ensure only one checkbox is checked
                            $(document).on('change', '.present-checkbox', function() {
                                if (this.checked) {
                                    $(this).closest('tr').find('.absent-checkbox').prop('checked', false);
                                }
                            });

                            $(document).on('change', '.absent-checkbox', function() {
                                if (this.checked) {
                                    $(this).closest('tr').find('.present-checkbox').prop('checked', false);
                                }
                            });
                        });
                    } else {
                        alert('No students found under this membership.');
                    }
                }
                , error: function() {
                    alert('Failed to fetch students.');
                }
            });
        }
    });

    // Handle course change
    $('#course').change(function() {
        var course = $(this).val();

        // Reset the students list and membership selection
        $('#students-list').empty();
        $('#membership_id').val('');

        if (course) {
            $.ajax({
                url: "{{ route('get-student-by-course') }}", // Ensure this route is defined in routes/web.php
                method: "GET"
                , data: {
                    course: course
                }
                , success: function(response) {
                    if (response.students.length > 0) {
                        $('#selected').text('Selected Course');

                        response.students.forEach(function(student, index) {
                            $('#students-list').append(`
                                <tr>
                                    <td>
                                        <input type="text" name="attendances[${index}][student_name]" class="form-control" value="${student.first_name} ${student.last_name}" required readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="attendances[${index}][student_id]" class="form-control" value="${student.student_id}" required readonly>
                                    </td>
                                     <td>
                                        <input type="text" name="attendances[${index}][course]" class="form-control" value="${course}" placeholder="${response.course_title}" required readonly style="display:none;">
                                        <input type="text" class="form-control" value="${response.course_title}" required readonly>
                                    </td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input present-checkbox" type="radio" id="present_${index}" name="attendances[${index}][attendance_status]" required value="present" />
                                            <label class="form-check-label" for="present_${index}">Present</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input absent-checkbox" type="radio" id="absent_${index}" name="attendances[${index}][attendance_status]" value="absent" />
                                            <label class="form-check-label" for="absent_${index}">Absent</label>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        });

                        // Ensure only one checkbox is checked using event delegation
                        $('#students-list').on('change', '.present-checkbox', function() {
                            if (this.checked) {
                                $(this).closest('tr').find('.absent-checkbox').prop('checked', false);
                            }
                        });

                        $('#students-list').on('change', '.absent-checkbox', function() {
                            if (this.checked) {
                                $(this).closest('tr').find('.present-checkbox').prop('checked', false);
                            }
                        });

                    } else {
                        alert('No students found under this course.');
                    }

                }
                , error: function() {
                    alert('Failed to fetch students.');
                }
            });
        }
    });

</script>

@endsection
