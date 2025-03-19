@extends('auth.admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
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
                            <li class="breadcrumb-item active">Studnet Registration</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                Student Registration
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.student-registration') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" name="first_name" id="first_name" class="form-control"
                                                    placeholder="Enter first name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="last_name" id="last_name" class="form-control"
                                                    placeholder="Enter last name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Enter email id">
                                                <p class="text-danger" id="email-error"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Mobile Number</label>
                                                <input type="text" name="phone_number" id="phone_number"
                                                    class="form-control" placeholder="Enter mobile number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Membership</label>
                                                <select name="membership_id[]" id="membership_id" class="form-control"
                                                    multiple>
                                                    <option value="">Select Membership</option>
                                                    @foreach ($memberships as $membership)
                                                        <option value="{{ $membership->membership_id }}">
                                                            {{ $membership->membership_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Select Course</label>
                                                <select name="course_id[]" id="course_id" class="form-control" multiple>
                                                    <option value="">Select Course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->course_title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Select Mentor</label>
                                                <select name="mentor_id" class="form-control" id="mentor_id">
                                                    <option value="">Select Mentor</option>
                                                    @foreach ($mentors as $mentor)
                                                        <option value="{{ $mentor->student_id }}">
                                                            {{ $mentor->first_name . ' ' . $mentor->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Upload Profile Picture</label>
                                                <input type="file" name="profile_picture" id="profile_picture"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-success">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                All Student
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <th>S.N</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Phone Number</th>
                                        <th>Profile Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $key => $student)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $student->student_id }}</td>
                                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                                <td>{{ $student->phone_number }}</td>
                                                <td>
                                                    <img style="width: 60px"
                                                        src="{{ asset('storage/' . $student->profile_picture) }}"
                                                        alt="{{ $student->first_name . ' ' . $student->last_name }}">
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.student-change-status', $student->student_id) }}"
                                                        class="badge rounded-pill bg-{{ $student->status ? 'success' : 'warning' }}">{{ $student->status ? 'Active' : 'Inactive' }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.view-student-profile', $student->student_id) }}"
                                                        class="btn btn-sm btn-primary"> <i class="fas fa-folder"></i>
                                                        Profile</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {

            $('#email').on('change', function() {
                var email = $(this).val();
                $.ajax({
                    url: "{{ route('check-email-availability') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#email-error').text('Already Exist');
                        } else {
                            $('#email-error').text('');
                        }
                    },
                    error: function(error) {
                        alert(error.message);
                    }
                });
            });

        });
    </script>
@endsection
