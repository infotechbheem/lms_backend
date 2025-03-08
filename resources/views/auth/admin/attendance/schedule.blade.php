@extends('auth.admin.layouts.app')

@section('main-content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance Department</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Schedule</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header text-center d-flex" style="border: 1px solid green; align-items: center;">
                    <div class="col-6">
                        <h5 class="m-0 p-0 text-left">All Schedule</h5>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#addSchedule"><i class="fas fa-plus mr-1"></i>Add Schedule</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12 mt-2">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Schedule Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $key => $schedule)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $schedule->schedule }}</td>
                                    <td>{{ $schedule->in }}</td>
                                    <td>{{ $schedule->out }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success edit-btn" data-id="{{ $schedule->id }}" data-schedule="{{ $schedule->schedule }}" data-in="{{ $schedule->in }}" data-out="{{ $schedule->out }}" data-toggle="modal" data-target="#editScheduleModal">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </button>
                                        <a href="{{ route('admin.delete-shift', $schedule->id) }}" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Editing Schedule -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScheduleModalLabel">Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.update-shift') }}" method="post">
                    @csrf
                    <input type="hidden" name="scheduleId" id="scheduleId">
                    <div class="form-group">
                        <label for="editScheduleName">Schedule Name</label>
                        <input type="text" class="form-control" id="editScheduleName" name="schedule" required>
                    </div>
                    <div class="form-group">
                        <label for="editTimeIn">Time In</label>
                        <input type="time" class="form-control" id="editTimeIn" name="time_in" required>
                    </div>
                    <div class="form-group">
                        <label for="editTimeOut">Time Out</label>
                        <input type="time" class="form-control" id="editTimeOut" name="time_out" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // When Edit button is clicked
        $('.edit-btn').on('click', function() {
            var scheduleId = $(this).data('id');
            var scheduleName = $(this).data('schedule');
            var timeIn = $(this).data('in');
            var timeOut = $(this).data('out');

            // Populate modal with the selected schedule data
            $('#scheduleId').val(scheduleId);
            $('#editScheduleName').val(scheduleName);
            $('#editTimeIn').val(timeIn);
            $('#editTimeOut').val(timeOut);
        });
    });

</script>
@endsection
