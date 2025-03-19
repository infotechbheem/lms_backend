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
                            <li class="breadcrumb-item active">View Student Details</li>
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
                    <div class=" col-lg-3 col-md-4 col-sm-12">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('storage/' . $student->profile_picture) }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ $student->first_name . ' ' . $student->last_name }}</h3>

                                <p class="text-muted text-center">Student</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Student Id</b> <a class="float-right">{{ $student->student_id }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Mobile Number</b> <a class="float-right">{{ $student->phone_number }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Registration Date</b> <a
                                            class="float-right">{{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y') }}</a>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-block"><b>Get Certificates</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Student Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Update Details</strong> : <a
                                    href="{{ route('admin.update-student-details', $student->student_id) }}">Click Here</a>
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Student Role</strong>

                                <p class=" m-0 pl-3 text-muted">Student : Yes</p>
                                <p class=" m-0 pl-3 text-muted">Mentor : {{ isMentor($student->student_id) }}</p>
                                <p class=" m-0 pl-3 text-muted">Volunteer : {{ isVolunteer($student->student_id) }}</p>
                                <hr>
                                <strong><i class="fas fa-pencil-alt mr-1"></i> Total Student Registration</strong> :
                                <span>{{ number_format(totalStudentRegistrationOverStudent($student->student_id), 0) }}</span>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Student Id</th>
                                                <td>{{ $student->student_id ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>First Name</th>
                                                <td>{{ $student->first_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Name</th>
                                                <td>{{ $student->last_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $student->email ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Number</th>
                                                <td>{{ $student->phone_number ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth</th>
                                                <td>{{ $student->date_of_birth ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ $student->gender ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $student->adddress ?? 'N/A' }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>City</th>
                                                <td>{{ $student->city ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>State</th>
                                                <td>{{ $student->state ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Zip Code</th>
                                                <td>{{ $student->zip_code ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Country </th>
                                                <td>{{ $student->country ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Emergency Mobile Number </th>
                                                <td>{{ $student->emergency_contact_phone ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Emergency Email </th>
                                                <td>{{ $student->emergency_contact_email ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Occupation </th>
                                                <td>{{ $student->occupation ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Annual Income </th>
                                                <td>{{ $student->annual_income ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active"
                                            href="#all-registered-student"data-toggle="tab">All Register Student</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="all-registered-student">
                                        <table id="example1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.N</th>
                                                    <th>Student Id</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email Id</th>
                                                    <th>Registration Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredStudents as $key => $students)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $students->student_id }}</td>
                                                        <td>{{ $students->first_name }}</td>
                                                        <td>{{ $students->last_name }}</td>
                                                        <td>{{ $students->phone_number }}</td>
                                                        <td>{{ $students->email }}</td>
                                                        <td>{{ formatDateAndTime($students->created_at) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <!-- /.post -->
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>

                    <!-- /.col -->
                </div>
            </div>
        </section>
    </div>
@endsection
