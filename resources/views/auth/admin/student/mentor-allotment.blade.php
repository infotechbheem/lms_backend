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
                        <li class="breadcrumb-item active">Mentor Allotment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <form action="{{ route('admin.allot-mentor') }}" method="post">
                        <div class="row justify-content-center">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Choose Mentor</label>
                                    <select name="mentor_id" class="form-control select2" id="mentor_id">
                                        <option value="">--------- Select ---------</option>
                                        @foreach ($students as $student)
                                        <option value="{{ $student->student_id }}">{{ $student->first_name . ' ' . $student->last_name . ' / ' . $student->student_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button style="margin-top:32px" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    All Mentor
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Mentor Id </th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="mentor_tbody">
                            @foreach ($mentors as $key => $mentor)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $mentor->student_id }}</td>
                                <td>{{ $mentor->first_name . ' ' . $mentor->last_name }}</td>
                                <td>{{ $mentor->phone_number }}</td>
                                <td>{{ $mentor->email }}</td>
                                <td>{{ $mentor->address ?? "Not Available" }}</td>
                                <td>
                                    <a href="javascript:void(0);" data-mentor-id="{{ $mentor->student_id }}" class="btn btn-sm btn-primary viewStudentBtn">
                                        <i class="fas fa-eye"></i> View Student
                                    </a>
                                    <a href="{{ route ('admin.delete-mentor', $mentor->student_id) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" style="display:none" id="mentor-student-card">
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Student Id</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Email Id</th>
                                <th>Creatd At</th>
                            </tr>
                        </thead>
                        <tbody id="student-data-retrive">

                        </tbody>
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
        // Handle the click event for the "View Student" buttons
        $(".viewStudentBtn").click(function(event) {
            event.preventDefault(); // Prevent the default link behavior

            var mentorId = $(this).data("mentor-id"); // Get the mentor id from the data-attribute

            // Clear previous table rows
            $('#student-data-retrive').empty();
            // Make an AJAX request to fetch the student details
            $.ajax({
                url: "{{ route('get-student-record') }}"
                , type: "GET"
                , data: {
                    mentor_id: mentorId
                }
                , success: function(response) {

                    if (response.status) {
                        if (response.data && response.data.length > 0) {
                            // Show the table
                            $('#mentor-student-card').show();

                            // Loop through responses and add them to the table
                            response.data.forEach(function(item, index) {
                                var tableRows = "<tr>" +
                                    "<td>" + (index + 1) + "</td>" +
                                    "<td>" + (item.student_id) + "</td>" + // Created By
                                    "<td>" + (item.first_name + ' ' + item.last_name) + "</td>" + // Created By
                                    "<td>" + (item.phone_number || 'N/A') + "</td>" + // Response (fallback to 'N/A' if null)
                                    "<td>" + (item.email || 'N/A') + "</td>" + // Response (fallback to 'N/A' if null)
                                    "<td>" + (new Date(item.created_at).toLocaleString()) + "</td>" + // Created At
                                    "</tr>";

                                // Append the table rows to the tbody
                                $('#student-data-retrive').append(tableRows);
                            });
                        } else {
                            alert('No responses found for this student.');
                        }
                    } else {
                        alert('Failed to fetch responses.');
                    }

                }
                , error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

</script>

@endsection
