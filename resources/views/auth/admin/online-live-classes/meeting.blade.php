@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Online Live Classes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Meeting</li>
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
                <div class="card-header">Assign Created Meetings</div>
                <div class="card-body">
                    <form action="{{ route('admin.store-meeting_links') }}" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Course</label>
                                    <select name="course[]" id="course_id" class="form-control" multiple>
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Membership</label>
                                    <select name="membership[]" id="membership_id" class="form-control" multiple>
                                        <option value="">Select Membeership</option>
                                        @foreach ($memberships as $membership)
                                        <option value="{{ $membership->membership_id }}">{{ $membership->membership_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Student</label>
                                    <select name="student[]" id="student" class="form-control" multiple>
                                        <option value="">Select Student</option>
                                        @foreach ($students as $student)
                                        <option value="{{ $student->student_id }}">{{ fullName($student->first_name, $student->last_name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="meeting_id">Meeting</label>
                                    <select class="form-control" id="meeting_id" name="meeting_id" required>
                                        <option value="">Select Meetings</option>
                                        @foreach ($meetings as $meeting)
                                        <option value="{{ $meeting['id'] }}">{{ $meeting['topic'] . ' / ' . $meeting['id'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary shadow-lg" style="height: max-content;margin-top: 32px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Upcomming Meetings</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Meeting Id</th>
                                <th>Host Id</th>
                                <th>Topic</th>
                                <th>Start Time</th>
                                <th>Duration</th>
                                <th>Public Join Url</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $key => $meeting)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $meeting['id'] }}</td>
                                <td>{{ $meeting['host_id'] }}</td>
                                <td>{{ $meeting['topic'] }}</td>
                                <td>{{ $meeting['start_time'] }}</td>
                                <td>{{ $meeting['duration'] }}</td>
                                <td>
                                    <!-- Add "Click Here" link -->
                                    <a href="javascript:void(0);" class="btn btn-sm btn-info" onclick="copyToClipboard('{{ $meeting['join_url'] }}')">Click Here</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.get-metting-details', $meeting['id']) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.delete-meetings', $meeting['id']) }}" class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash"></i></a>
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

<!-- Add the script for copy to clipboard functionality -->
<script>
    function copyToClipboard(url) {
        // Create a temporary textarea element to copy the URL
        var tempInput = document.createElement("input");
        tempInput.value = url;
        document.body.appendChild(tempInput);

        // Select and copy the URL
        tempInput.select();
        document.execCommand("copy");

        // Remove the temporary input after copying
        document.body.removeChild(tempInput);

        // Optionally, show an alert or a tooltip to confirm the URL is copied
        alert("Join URL copied to clipboard!");
    }

</script>
@endsection
