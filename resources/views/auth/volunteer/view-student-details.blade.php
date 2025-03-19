@extends('auth.volunteer.layouts.app')

@section('main-section')
    <div class="container-fluid">
        <div class="bg-light rounded p-4 shadow-lg">
            <div class="card">
                <div class="card-header text-center">Student Details</div>'
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Student Id : </strong>{{ $student->student_id }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>First Name : </strong>{{ $student->first_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Last Name : </strong>{{ $student->last_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Email : </strong>{{ $student->email }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Mobile Number : </strong>{{ $student->phone_number }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Date Of Birth : </strong>{{ $student->date_of_birth }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Gender : </strong>{{ $student->gender }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Address : </strong>{{ $student->address }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>City : </strong>{{ $student->city }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>State : </strong>{{ $student->state }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Zip Code : </strong>{{ $student->zip_code }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Country : </strong>{{ $student->country }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Emergency Mobile Number : </strong>{{ $student->emergency_contact_phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Emergency Email Id : </strong>{{ $student->emergency_contact_email }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Occupation : </strong>{{ $student->occupation }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Annual Income : </strong>{{ $student->annual_income }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Created At : </strong>{{ $student->created_at }}</p>
                        </div>
                        <div class="col-md-12">
                            <!-- Displaying course names -->
                            <p><strong>Courses : </strong> {{ getCourseName($student->course_id) }}</p>
                        </div>
                        <div class="col-md-12">
                            <!-- Displaying course names -->
                            <p><strong>Memberhsip : </strong> {{ getMembership($student->membership_id) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
