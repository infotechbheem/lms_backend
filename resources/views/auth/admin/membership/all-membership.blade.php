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
                                <td>{{ $member->selling_price }}</td>
                                <td>
                                    @if ($member->cover_image)
                                    <img style="width: 100px; height: auto;" src="{{ asset('storage/' .  $member->cover_image) }}" alt="">
                                    @else
                                    "N/A"
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary getMembershipDetails" data-membership_id="{{ $member->membership_id }}">View</button>
                                    <a href="{{ route('admin.delete-membership', $member->id) }}" class="btn btn-outline-danger delete-btn">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card card-success" style="display: none">
                <div class="card-header">Membership Name: <span id="membership_name"></span></div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Membership ID</th>
                            <td id="membership_id"></td>
                        </tr>
                        <tr>
                            <th>Membership Name</th>
                            <td id="response_membership_name"></td>
                        </tr>
                        <tr>
                            <th>Plan</th>
                            <td id="plan"></td>
                        </tr>
                        <tr>
                            <th>Currency</th>
                            <td id="currency"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td id="description"></td>
                        </tr>
                        <tr>
                            <th>Selling Price</th>
                            <td id="selling_price"></td>
                        </tr>
                        <tr>
                            <th>Discount Price</th>
                            <td id="discount_price"></td>
                        </tr>
                        <tr>
                            <th>Cover Image</th>
                            <td id="cover_image"></td>
                        </tr>
                        <tr>
                            <th>Created Date & Time</th>
                            <td id="created_at"></td>
                        </tr>
                        <tr>
                            <th>Total Course Available</th>
                            <td id="total_courses_available"></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>


<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Handle the 'View' button click event
        $('.getMembershipDetails').click(function() {
            var membershipId = $(this).data('membership_id'); // Get the membership ID from the button

            // Fetch the membership details from the server
            $.ajax({
                url: "{{ route('get-membership-details') }}", // Correct the route here
                method: 'GET'
                , data: {
                    membership_id: membershipId
                }
                , success: function(response) {
                    if (response.status) {
                        var data = response.data;
                        var membershipName = data.membership_name;
                        var plan = data.plan;
                        var currency = data.currency;
                        var description = data.description;
                        var sellingPrice = data.selling_price;
                        var discountPrice = data.discount_price;
                        var coverImage = data.cover_image;
                        var createdAt = data.created_at;
                        var courseNames = data.course_names; // Now an array of course names

                        // Set the details to the second card
                        $('#membership_id').text(membershipId);
                        $('#membership_name').text(membershipName);
                        $('#response_membership_name').text(membershipName);
                        $('#plan').text(plan);
                        $('#currency').text(currency);
                        $('#description').text(description);
                        $('#selling_price').text(sellingPrice);
                        $('#discount_price').text(discountPrice);

                        // Show the cover image if available
                        if (coverImage) {
                            $('#cover_image').html('<img style="width: 100px; height: auto;" src=" {{ asset("storage") }}/' + coverImage + '" alt="Cover Image">');
                        } else {
                            $('#cover_image').text('N/A');
                        }

                        $('#created_at').text(createdAt);

                        // Display the courses in small boxes
                        var coursesHTML = '';
                        courseNames.forEach(function(courseName) {
                            // You can fetch course details by using the courseId (e.g., AJAX request or pre-defined array)
                            // coursesHTML += '<div class="course-box" style="display: inline-block; padding: 10px; margin: 5px; border: 1px solid #ddd; border-radius: 5px;">' + "View Course" + '</div>';
                            coursesHTML += '<span class="badge rounded-pill bg-primary mr-1">' + courseName + '</span>';
                        });

                        // Insert the course boxes into the page
                        $('#total_courses_available').html(coursesHTML);

                        // Show the second card with details
                        $('.card-success').show();
                    } else {
                        alert('Error fetching membership details.');
                    }
                }
                , error: function(error) {
                    console.error('AJAX Error:', error);
                    alert('Failed to load membership details.');
                }
            });
        });
    });

</script>


@endsection
