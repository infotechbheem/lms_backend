@extends('auth.admin.layouts.app')

@section('main-content')
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
                        <li class="breadcrumb-item active">Calling Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    Calling Student
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th>S.N.</th>
                            <th>Student Id</th>
                            <th>Student Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->first_name . " " . $student->last_name }}</td>
                                <td>{{ $student->phone_number }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <!-- Trigger the Update Response Modal -->
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updateResponseModal" data-id="{{ $student->student_id }}" data-name="{{ $student->first_name . " " . $student->last_name }}">Update Response</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- View Response Section -->
            <div class="card card-success">
                <div class="card-header">
                    View Response
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-4">
                                <label for="">Select Student</label>
                                <select class="form-control select2" style="width: 100%;" id="selectStudent">
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                    <option value="{{ $student->id }}" data-name="{{ $student->first_name . ' ' . $student->last_name }}" data-id="{{ $student->student_id ?? '' }}">{{ $student->first_name. " ". $student->last_name . ' / ' . $student->student_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" id="viewResponseBtn" class="btn btn-warning" style="margin-top: 32px">View</button>
                            </div>
                        </div>
                    </form>

                    <div class="row" id="viewResponseOfCallingStudent" style="display:none">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>S.N.</th>
                                <th>Created By</th>
                                <th>Response</th>
                                <th>Created At</th>
                            </thead>
                            <tbody id="calling_student_response">
                                <!-- Dynamic content goes here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Update Response -->
<div class="modal fade" id="updateResponseModal" tabindex="-1" role="dialog" aria-labelledby="updateResponseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateResponseModalLabel">Update Response</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateResponseForm" method="POST" action="{{ route('admin.calling-student-response-store') }}">
                    @csrf
                    <input type="hidden" name="student_id" id="student_id">
                    <div class="form-group">
                        <label for="student_name">Student Name</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="response">Response</label>
                        <textarea class="form-control" id="response" name="response" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Response</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Update Response Modal - Set Student Details
        $('#updateResponseModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var studentId = button.data('id');
            var studentName = button.data('name');

            var modal = $(this);
            modal.find('#student_id').val(studentId);
            modal.find('#student_name').val(studentName);
        });

        // View Response Modal - Show Student Response
        $('#viewResponseBtn').on('click', function() {
            var selectedStudent = $('#selectStudent').find(':selected');
            var studentId = selectedStudent.data('id');
            var studentName = selectedStudent.data('name');

            // Clear previous table rows
            $('#calling_student_response').empty();

            $.ajax({
                url: "{{ route('get-calling-response') }}"
                , method: 'GET'
                , data: {
                    student_id: studentId
                }
                , success: function(response) {
                    console.log(response); // Log the response to check its structure

                    if (response.status) {
                        if (response.data && response.data.length > 0) {
                            // Show the table
                            $('#viewResponseOfCallingStudent').show();

                            // Loop through responses and add them to the table
                            response.data.forEach(function(item, index) {
                                var tableRows = "<tr>" +
                                    "<td>" + (index + 1) + "</td>" +
                                    "<td>" + (item.name) + "</td>" + // Created By
                                    "<td>" + (item.response || 'N/A') + "</td>" + // Response (fallback to 'N/A' if null)
                                    "<td>" + (new Date(item.created_at).toLocaleString()) + "</td>" + // Created At
                                    "</tr>";

                                // Append the table rows to the tbody
                                $('#calling_student_response').append(tableRows);
                            });
                        } else {
                            alert('No responses found for this student.');
                        }
                    } else {
                        alert('Failed to fetch responses.');
                    }
                }
                , error: function(error) {
                    console.log(error);
                    alert('Error fetching student response.');
                }
            });
        });
    });

</script>

@endsection
