@extends('auth.student.layouts.app')

@section('main-section')
<div class="content-wrapper">

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
    <div class="card bg-gradient-primary">
        <div class="card-header">
            <div class="d-flex" style="justify-content: space-between; align-items: center;">
                <div class="card-title m-0 text-white">Student Question Answer</div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#storeQuestionAnswer">Ask Question</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped custom-transparent-table">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Course Name</th>
                            <th>Question</th>
                            <th>Attachments</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questionAnswers as $key => $questionAnswer)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ getSingleCourseName($questionAnswer->course_id) }}</td>
                            <td>{{ $questionAnswer->questions }}</td>
                            <td>{{ $questionAnswer->question_with_attachment ? "Yes" : "No" }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $questionAnswer->status ? "success" : "warning" }}">{{ $questionAnswer->status ? "Answered" : "Asked"}}</span>
                            </td>
                            <td>
                                {{ formatDateAndTime($questionAnswer->created_at) }}
                            </td>
                            <td>
                                <a href="{{ route('student.get-question-answer-details', $questionAnswer->encrypted_id) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
