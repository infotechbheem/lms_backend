@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Course Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Course Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card card-primary card-outline">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="memberhship-details-tab" data-toggle="pill" href="#membership-details" role="tab" aria-controls="memberhship-details-tab" aria-selected="true">Memberhsip Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="course-details-tab" data-toggle="pill" href="#course-details" role="tab" aria-controls="course-details-tab" aria-selected="false">Course Details</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="membership-details" role="tabpanel" aria-labelledby="memberhship-details-tab">
                            <table class="table table-bordered table-striped table-responsive-sm table-hover">
                                <tr>
                                    <th>Memberhsip Id</th>
                                    <td>{{ $membership->membership_id }}</td>
                                </tr>
                                <tr>
                                    <th>Membership Name</th>
                                    <td>{{ $membership->membership_name }}</td>
                                </tr>
                                <tr>
                                    <th>Plan</th>
                                    <td>{{ $membership->plan  }}</td>
                                </tr>
                                <tr>
                                    <th>Currency</th>
                                    <td>{{ $membership->currency }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $membership->description }}</td>
                                </tr>
                                <tr>
                                    <th>Selling Price</th>
                                    <td>₹ {{ number_format($membership->selling_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Discount Price</th>
                                    <td>₹ {{ number_format($membership->discount_price,2) }}</td>
                                </tr>
                                <tr>
                                    <th>Cover Image</th>
                                    <td><img src="{{ asset('storage/' . $membership->cover_image) }}" alt="Membership Cover Image"></td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ \Carbon\Carbon::parse($membership->created_at)->format('d-m-Y') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="course-details" role="tabpanel" aria-labelledby="course-details-tab">
                            <table class="table table-bordered table-striped table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Course Title</th>
                                        <th>Class Title</th>
                                        <th>Class Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Time</th>
                                        <th>Venue</th>
                                        <th>Cover Image</th>
                                        <th>Coordinator</th>
                                        <th>Fee Type</th>
                                        <th>Currency</th>
                                        <th>Discount Price</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course as $key => $class)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $class->course_title }}</td>
                                        <td>{{ $class->class_title }}</td>
                                        <td>{{ $class->class_type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($class->start_date)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($class->end_date)->format('d-m-Y') }}</td>
                                        <td>{{ $class->time }}</td>
                                        <td>{{ $class->venue }}</td>
                                        <td><img src="{{ asset('storage/' . $class->cover_image) }}" style="width: 100px" alt="Class Cover Image"></td>
                                        <td>{{ $class->coordinator }}</td>
                                        <td>{{ $class->fee_type }}</td>
                                        <td>{{ $class->currency }}</td>
                                        <td>�� {{ number_format($class->discount_price, 2) }}</td>
                                        <td>{{ $class->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($class->created_at)->format('d-m-Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>

@endsection
