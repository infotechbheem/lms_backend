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
                        <li class="breadcrumb-item active">Online Live Classes</li>
                        <li class="breadcrumb-item active">Create Zoom Link</li>
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
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.create-meeting') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <!-- Meeting Topic -->
                                <div class="mb-3">
                                    <label for="topic" class="form-label">Meeting Topic</label>
                                    <input type="text" class="form-control" id="topic" name="topic" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Meeting Agenda -->
                                <div class="mb-3">
                                    <label for="agenda" class="form-label">Agenda</label>
                                    <textarea class="form-control" id="agenda" name="agenda" rows="1" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Start Time -->
                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Duration (in minutes) -->
                                <div class="mb-3">
                                    <label for="duration" class="form-label">Duration (in minutes)</label>
                                    <input type="number" class="form-control" id="duration" name="duration" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Timezone -->
                                <div class="mb-3">
                                    <label for="timezone" class="form-label">Timezone</label>
                                    <input type="text" class="form-control" id="timezone" name="timezone" value="Asia/Kolkata" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Schedule For (Host Email) -->
                                <div class="mb-3">
                                    <label for="schedule_for" class="form-label">Schedule For (Host Email)</label>
                                    <input type="email" class="form-control" id="schedule_for" name="schedule_for" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Join Before Host -->
                                <div class="mb-3">
                                    <label for="join_before_host" class="form-label">Allow Join Before Host</label>
                                    <input type="checkbox" id="join_before_host" name="join_before_host">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Host Video -->
                                <div class="mb-3">
                                    <label for="host_video" class="form-label">Host Video On</label>
                                    <input type="checkbox" id="host_video" name="host_video" checked>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Participant Video -->
                                <div class="mb-3">
                                    <label for="participant_video" class="form-label">Participant Video On</label>
                                    <input type="checkbox" id="participant_video" name="participant_video" checked>
                                </div>

                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Mute Upon Entry -->
                                <div class="mb-3">
                                    <label for="mute_upon_entry" class="form-label">Mute Participants Upon Entry</label>
                                    <input type="checkbox" id="mute_upon_entry" name="mute_upon_entry">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Waiting Room -->
                                <div class="mb-3">
                                    <label for="waiting_room" class="form-label">Enable Waiting Room</label>
                                    <input type="checkbox" id="waiting_room" name="waiting_room">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Audio Options -->
                                <div class="mb-3">
                                    <label for="audio" class="form-label">Audio Type</label>
                                    <select class="form-control" id="audio" name="audio" required>
                                        <option value="both" selected>Both (VoIP + Telephony)</option>
                                        <option value="telephony">Telephony</option>
                                        <option value="voip">VoIP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Auto Recording -->
                                <div class="mb-3">
                                    <label for="auto_recording" class="form-label">Auto Recording</label>
                                    <select class="form-control" id="auto_recording" name="auto_recording" required>
                                        <option value="none">None</option>
                                        <option value="local">Local</option>
                                        <option value="cloud" selected>Cloud</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <!-- Approval Type -->
                                <div class="mb-3">
                                    <label for="approval_type" class="form-label">Approval Type</label>
                                    <select class="form-control" id="approval_type" name="approval_type" required>
                                        <option value="0" selected>Automatically Approve</option>
                                        <option value="1">Manually Approve</option>
                                        <option value="2">No Registration Required</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Meeting</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
