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
                        <li class="breadcrumb-item active">Meeting Details</li>
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
                <div class="card-header">View Meetings Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>UUID</th>
                                        <td>{{ $data['uuid'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meeting Id</th>
                                        <td>{{ $data['id'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Host Id</th>
                                        <td>{{ $data['host_id'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Host Email</th>
                                        <td>{{ $data['host_email'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Assistant Id</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Topic</th>
                                        <td>{{ $data['topic'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ $data['type'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $data['status'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Start Time</th>
                                        <td>{{ $data['start_time'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration</th>
                                        <td>{{ $data['duration'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Timezone</th>
                                        <td>{{ $data['timezone'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agenda</th>
                                        <td>{{ $data['agenda'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created_at</th>
                                        <td>{{ $data['created_at'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Start Url</th>
                                        <td onclick="copyToClipboard('{{ $data['start_url'] }}')"><a href="#" class="badge rounded-pill bg-primary">Copy</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Join Url</th>
                                        <td onclick="copyToClipboard('{{ $data['join_url'] }}')"><a href="#" class="badge rounded-pill bg-primary">Copy</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td onclick="copyToClipboard('{{ $data['password'] }}')">{{ $data['password'] }} <span class="badge rounded-pill bg-warning">Copy</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Meetings is shared to </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col">Column</div>
                        <div class="col">Column</div>
                        <div class="col">Column</div>
                    </div>
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
        alert("Copied to clipboard!");
    }

</script>
@endsection
