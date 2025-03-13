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
                                <th>Discription</th>
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
                                    <button class="btn btn-sm btn-outline-primary" data-membership_id="{{ $member->membership_id }}" data-description="{{ $member->description }}">click Here</button>
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

<!-- Modal -->
<div class="modal fade" id="membershipModal" tabindex="-1" role="dialog" aria-labelledby="membershipModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="membershipModalLabel">Membership Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="membershipDescriptionText">Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
    $(document).ready(function() {
        // Handle the 'View' button click event
        $('.getMembershipDetails').click(function() {
            var membershipDescription = $(this).data('description'); // Get the description

            // Set the description text into the modal
            $('#membershipDescriptionText').text(membershipDescription);

            // Show the modal (Bootstrap 4 syntax)
            $('#membershipModal').modal('show');
        });
    });

</script>

@endsection
