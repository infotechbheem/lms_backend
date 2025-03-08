@extends('auth.student.layouts.app')

@section('main-section')
<style>
    .course-box {
        display: inline-block;
        padding: 28px;
        border: 1px solid;
        border-radius: 10px;
        background: antiquewhite;
    }

</style>
<div class="content-wrapper">
    <div class="row">
        <!-- Courses Table -->
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Course Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Course title</th>
                                    <th>Class Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $key => $course)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $course->course_title }}</td>
                                    <td>{{ upperCase($course->class_type) }}</td>
                                    <td>{{ formatDate($course->start_date ) }}</td>
                                    <td>{{ formatDate($course->end_date) }}</td>
                                    <td>{{ formatTime($course->time) }}</td>
                                    <td>
                                        <span class="badge badge-success">Active</span>
                                    </td>
                                    <td>
                                        <button data-course-id="{{ $course->id }}" id="getCourseDetails" class="btn btn-sm btn-primary">
                                            View
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Membership Table -->
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Membership Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Membership Id</th>
                                    <th>Membership Title</th>
                                    <th>Plan</th>
                                    <th>Cover Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($memberships as $key => $member)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $member->membership_id }}</td>
                                    <td>{{ $member->membership_name }}</td>
                                    <td>{{ $member->plan }}</td>
                                    <td>
                                        <!-- Display image thumbnail with a click event to open modal -->
                                        <img src="{{ showImage($member->cover_image) }}" alt="Membership Image" class="membership-image" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="{{ showImage($member->cover_image) }}" style="width: 50px; cursor: pointer;">
                                    </td>
                                    <td>
                                        <button data-membership-id="{{ $member->membership_id }}" id="getMembershipDetails" class="btn btn-sm btn-primary">
                                            View
                                        </button>
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

    <div class="card stretch-card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-title">Course Title</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Course Title:</th>
                                <td id="response_course_title"></td>
                            </tr>
                            <tr>
                                <th>Class Title :</th>
                                <td id="response_class_title"></td>
                            </tr>
                            <tr>
                                <th>Class Type :</th>
                                <td id="response_class_type"></td>
                            </tr>
                            <tr>
                                <th>Start Date :</th>
                                <td id="response_start_date"></td>
                            </tr>
                            <tr>
                                <th>End Date :</th>
                                <td id="response_end_date"></td>
                            </tr>
                            <tr>
                                <th>Time :</th>
                                <td id="response_time"></td>
                            </tr>
                            <tr>
                                <th>Venue :</th>
                                <td id="response_venue"></td>
                            </tr>
                            <tr>
                                <th>Coordinator :</th>
                                <td id="response_coordinator"></td>
                            </tr>
                            <tr>
                                <th>Discount Price :</th>
                                <td id="response_discount_price"></td>
                            </tr>
                            <tr>
                                <th>Description :</th>
                                <td id="response_discription"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-title">Mombership Details</div>

                    <div class="course-container">
                        <div class="course-box">
                            <p class="m-0" id="course-title">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal to display image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Membership Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- The image will be displayed here -->
                <img id="modalImage" src="" alt="Full Membership Image" class="img-fluid" />
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle JS (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // When an image is clicked, update the modal image source
    var myModal = new bootstrap.Modal(document.getElementById('imageModal'), {});
    document.querySelectorAll('.membership-image').forEach(function(image) {
        image.addEventListener('click', function(event) {
            var imageUrl = image.getAttribute('data-bs-image'); // Extract the image URL from the data-* attribute
            console.log('Image URL:', imageUrl); // Debugging step: check the URL in console

            // If the URL is correct, it will show in the modal. If the image doesn't show, check the URL in the console
            if (imageUrl) {
                document.getElementById('modalImage').setAttribute('src', imageUrl); // Set the src of the modal image
                myModal.show(); // Show the modal
            } else {
                console.error('No image URL found.');
            }
        });
    });

    $(document).ready(function() {

        $(document).on("click", "#getCourseDetails", function() {
            var courseId = $(this).data('course-id');

            $.ajax({
                url: "{{ route('get-course-details') }}"
                , method: "GET"
                , data: {
                    course_id: courseId
                , }
                , success: function(response) {
                    if (response.status) {
                        // Populate the course details table with the course data
                        $('#response_course_title').text(response.data.course_title);
                        $('#response_class_title').text(response.data.class_title);
                        $('#response_class_type').text(response.data.class_type);
                        $('#response_start_date').text(response.data.start_date);
                        $('#response_end_date').text(response.data.end_date);
                        $('#response_time').text(response.data.time);
                        $('#response_venue').text(response.data.venue);
                        $('#response_coordinator').text(response.data.coordinator);
                        $('#response_discount_price').text("₹ " + response.data.discount_price);
                        $('#response_discription').text(response.data.description);
                    }
                }
                , error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        });

        $(document).on("click", "#getMembershipDetails", function() {
            var membshipId = $(this).data('membership-id');

            $.ajax({
                url: "{{ route('get-membership-records') }}"
                , method: "GET"
                , data: {
                    membership_id: membshipId
                , }
                , success: function(response) {
                    if (response.status) {
                        var courses = response.courses;
                        console.log(courses);

                        if (courses && courses.length > 0) {
                            var courseNames = courses.map(function(course) {
                                return course.course_title;
                            }).join(', ');

                            $("#course-title").text(courseNames);
                        } else {
                            $("#course-title").text('No courses found for this membership.');
                        }
                    }
                }
                , error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        });
    });

</script>

@endsection
