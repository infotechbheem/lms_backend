@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Course
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Created Course</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex" style="justify-content: space-between; align-items: center;">
                        <div class="card-title"><strong>Created Course / Class</strong></div>
                        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#createNewCourse"><i class="fas fa-plus mr-1"></i> Add New Course</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Course Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Time</th>
                                <th>Cover Image</th>
                                <th>Discount</th>
                                <th>Membership ID</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $key => $class)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $class->course_title }}</td>
                                <td>{{ formatDate($class->start_date) }}</td>
                                <td>{{ formatDate($class->end_date) }}</td>
                                <td>{{ formatTime($class->time) }}</td>
                                <td>
                                    <img src="{{ showImage($class->cover_image) }}" alt="{{ $class->course_title }}">
                                </td>
                                <td>₹ {{ number_format($class->discount_price, 2) }}</td>
                                <td>{{ $class->membership_id }}</td>
                                <td>{{ $class->description }}</td>
                                <td>
                                    <!-- View Course Details -->
                                    <a href="{{ route('admin.view-course-details', $class->encrypted_id) }}" class="btn btn-sm btn-warning" title="View Course Material Details"><i class="fas fa-eye"></i></a>

                                    {{-- <!-- Edit Modal Button -->
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editClassModal" data-id="{{ $class->id }}" data-course_title="{{ $class->course_title }}" data-class_title="{{ $class->class_title }}" data-class_type="{{ $class->class_type }}" data-date="{{ $class->date }}" data-time="{{ $class->time }}" data-fee_type="{{ $class->fee_type }}" data-currency="{{ $class->currency }}" data-discount_price="{{ $class->discount_price }}" data-coordinator="{{ $class->coordinator }}" data-venue="{{ $class->venue }}" data-cover_image="{{ $class->cover_image }}">
                                    <i class="fas fa-edit"></i>
                                    </button> --}}

                                    <!-- Delete Button -->
                                    <a href="{{ route('admin.delete-course', $class->id) }}" class="btn btn-sm btn-danger delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </a>
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

<!-- Edit Class Modal -->
<div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassModalLabel">Edit Offline Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editClassForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="classId" name="id">

                    <!-- Form fields for class details -->
                    <div class="form-group">
                        <label for="course_title">Course Title</label>
                        <input type="text" class="form-control" id="course_title" name="course_title" required>
                    </div>

                    <div class="form-group">
                        <label for="class_title">Class Title</label>
                        <input type="text" class="form-control" id="class_title" name="class_title" required>
                    </div>

                    <div class="form-group">
                        <label for="class_type">Class Type</label>
                        <input type="text" class="form-control" id="class_type" name="class_type" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>

                    <div class="form-group">
                        <label for="fee_type">Fee Type</label>
                        <input type="text" class="form-control" id="fee_type" name="fee_type" required>
                    </div>

                    <div class="form-group">
                        <label for="currency">Currency</label>
                        <input type="text" class="form-control" id="currency" name="currency" required>
                    </div>

                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" class="form-control" id="discount_price" name="discount_price" required>
                    </div>

                    <div class="form-group">
                        <label for="coordinator">Coordinator Name</label>
                        <input type="text" class="form-control" id="coordinator" name="coordinator" required>
                    </div>

                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <input type="text" class="form-control" id="venue" name="venue" required>
                    </div>

                    <div class="form-group">
                        <label for="cover_image">Cover Image</label>
                        <input type="file" class="form-control" id="cover_image" name="cover_image">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Edit Class Modal (Edit button clicks)
        $('#editClassModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            var id = button.data('id');
            var courseTitle = button.data('course_title');
            var classTitle = button.data('class_title');
            var classType = button.data('class_type');
            var date = button.data('date');
            var time = button.data('time');
            var feeType = button.data('fee_type');
            var currency = button.data('currency');
            var discountPrice = button.data('discount_price');
            var coordinator = button.data('coordinator');
            var venue = button.data('venue');

            var modal = $(this);

            // Fill in the values in the modal form fields
            modal.find('#classId').val(id);
            modal.find('#course_title').val(courseTitle);
            modal.find('#class_title').val(classTitle);
            modal.find('#class_type').val(classType);
            modal.find('#date').val(date);
            modal.find('#time').val(time);
            modal.find('#fee_type').val(feeType);
            modal.find('#currency').val(currency);
            modal.find('#discount_price').val(discountPrice);
            modal.find('#coordinator').val(coordinator);
            modal.find('#venue').val(venue);
        });
    });

</script>

@endsection
