@extends('auth.student.layouts.app')

@section('main-section')

<style>
    /* Specific selector for table inside .card */
    .card .table.custom-transparent-table {
        background-color: transparent !important;
    }

    /* Additionally, ensure that striped rows and borders don’t have any background color */
    .card .table.custom-transparent-table tbody tr,
    .card .table.custom-transparent-table th,
    .card .table.custom-transparent-table td {
        background-color: transparent !important;
        border-color: #ddd;
        color: #ffff;
        /* Optional: Adjust border color */
    }

    .form-group label {
        color: white !important;
    }

    select {
        background-color: #ddd !important;
        color: #001737 !important;
    }

</style>

<div class="content-wrapper">
    <div class="row">
        <!-- Courses Table -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card bg-gradient-primary">
                <div class="card-body">
                    <h4 class="card-title">Assignment</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered custom-transparent-table">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Assignment Title</th>
                                    <th>Passing Percentage</th>
                                    <th>Retake Allowed</th>
                                    <th>Assignments Created At</th>
                                    <th>Obtain Marks</th>
                                    <th>Attempt</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignments as $key => $assignment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $assignment->assignment_title }}</td>
                                    <td>{{ number_format($assignment->passing_percentage,0) }} % </td>
                                    <td>{{ $assignment->retake_allowed }} Times Only</td>
                                    <td>{{ formatDateAndTime($assignment->created_at) }}</td>
                                    <td>40%</td>
                                    <td>2</td>
                                    <td>
                                        <a href="{{ route('student.view-assignment', ['assignment_id' => $assignment->encrypted_id]) }}" class="btn btn-sm btn-primary">View</a>
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
</div>


@endsection
