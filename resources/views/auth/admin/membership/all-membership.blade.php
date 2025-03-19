@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Membership / Lavel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Membership</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    All Membership / Lavel
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Membership Id</th>
                                <th>Name</th>
                                <th>Plan</th>
                                <th>Currency</th>
                                <th>Selling Price</th>
                                <th>Discount Price</th>
                                <th>Cover Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($memberships as $key => $member)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $member->membership_id }}</td>
                                <td>{{ $member->membership_name }}</td>
                                <td>{{ $member->plan }}</td>
                                <td>{{ $member->currency }}</td>
                                <td>₹ {{ number_format($member->selling_price,2) }}</td>
                                <td>₹ {{ number_format($member->discount_price,2) }}</td>
                                <td>
                                    @if ($member->cover_image)
                                    <img style="width: 100px; height: auto;" src="{{ asset('storage/' .  $member->cover_image) }}" alt="">
                                    @else
                                    "N/A"
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.view-membership-details', $member->membership_id) }}" class="btn btn-sm btn-outline-success">view</a>
                                    <a href="{{ route('admin.delete-membership', $member->id) }}" class="btn btn-sm btn-outline-danger delete-btn">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
