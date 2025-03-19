@extends('auth.admin.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Question Answering</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Question Answer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Questions</th>
                        <th>Question Attachment</th>
                        <th>Status</th>
                        <th>Asked Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $key => $question)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $question->student_id }}</td>
                        <td>{{ getStudentName($question->student_id) }}</td>
                        <td>{{ $question->course_id }}</td>
                        <td>{{ $question->questions }}</td>
                        <td>{{ $question->question_with_attachment ? "Yes" : "No" }}</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $question->status ? "success" : "warning" }}">{{ $question->status ? "Resolved" : "Asked" }}</span>
                        </td>
                        <td>{{ formatDateAndTime($question->created_at) }}</td>
                        <td>
                            <a href="{{ route('admin.view-question-answering', $question->encrypted_id) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>


@endsection
