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
                        <li class="breadcrumb-item active">Update Student Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.store-student-updated-details', $student->student_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $student->first_name }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $student->last_name }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Email Id</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $student->phone_number }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Date of Birth</label>
                            <input type="text" class="form-control" name="date_of_birth" id="" value="{{ $student->date_of_birth }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Select Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="male" {{ $student->gender == "male" ? "selected" : "" }}>Male</option>
                                <option value="female" {{ $student->gender == "female" ? "selected" : "" }}>Female</option>
                                <option value="Other" {{ $student->gender == "other" ? "selected" : "" }}>other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" id="address" class="form-control" name="Address" rows="5">{{ $student->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" class="form-control" id="city" name="City" value="{{ $student->city }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ $student->state }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $student->zip_code }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ $student->country }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Emergency Contact Number</label>
                            <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" value="{{ $student->emergency_contact_phone }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Emergency Contact Email</label>
                            <input type="text" class="form-control" id="emergency_contact_email" name="emergency_contact_email" value="{{ $student->emergency_contact_email }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" value="{{ $student->occupation }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Annual Income</label>
                            <input type="text" class="form-control" id="annual_income" name="annual_income" value="{{ $student->annual_income }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="">Upload Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image" accept=".jpeg , .png, .jpg">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">Update Details</button>
            </form>
        </div>
    </section>
</div>

@endsection
