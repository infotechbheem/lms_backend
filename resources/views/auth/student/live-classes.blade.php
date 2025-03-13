@extends('auth.student.layouts.app')

@section('main-section')
<div class="content-wrapper">
    <div class="row">
        <!-- Courses Table -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Created Classess</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Meetings Id</th>
                                    <th>Topic</th>
                                    <th>Agenda</th>
                                    <th>Start Time</th>
                                    <th>Duration</th>
                                    <th>Join Link</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meetingDetails as $meetings)
                                <tr>
                                    <td>{{ $meetings['data']['id'] }}</td>
                                    <td>{{ $meetings['data']['topic'] }}</td>
                                    <td>{{ $meetings['data']['agenda'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($meetings['data']['start_time'])->format('d-m-Y h:i:A') }}</td>
                                    <td>{{ $meetings['data']['duration'] }} Min</td>
                                    <td>
                                        <a href="{{ $meetings['data']['join_url'] }}" target="_blank" class="btn btn-sm btn-primary">Click Here</a>
                                    </td>
                                    <td>
                                        <span id="password-{{ $meetings['data']['id'] }}" class="password-text" data-password="{{ $meetings['data']['password'] }}"></span>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="copyPassword('{{ $meetings['data']['id'] }}')">Click to Copy</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center">
                            {{ $meetingIdsPaginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Upcoming Classes</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Meetings Id</th>
                                    <th>Topic</th>
                                    <th>Agenda</th>
                                    <th>Start Time</th>
                                    <th>Duration</th>
                                    <th>Join Link</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(now() < \Carbon\Carbon::parse($meetings['data']['start_time']) ) @foreach ($meetingDetails as $meetings) <tr>
                                    <td>{{ $meetings['data']['id'] }}</td>
                                    <td>{{ $meetings['data']['topic'] }}</td>
                                    <td>{{ $meetings['data']['agenda'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($meetings['data']['start_time'])->format('d-m-Y h:i:A') }}</td>
                                    <td>{{ $meetings['data']['duration'] }} Min</td>
                                    <td>
                                        <a href="{{ $meetings['data']['join_url'] }}" target="_blank" class="btn btn-sm btn-primary">Click Here</a>
                                    </td>
                                    <td>
                                        <span id="password-{{ $meetings['data']['id'] }}" class="password-text" data-password="{{ $meetings['data']['password'] }}"></span>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="copyPassword('{{ $meetings['data']['id'] }}')">Click to Copy</button>
                                    </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">Not Data Found</td>
                                    </tr>
                                    @endif
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center">
                            {{ $meetingIdsPaginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyPassword(meetingId) {
            var passwordText = document.getElementById('password-' + meetingId);
            var password = passwordText.getAttribute('data-password');
            var tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = password;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Password copied to clipboard!');
        }

    </script>

    @endsection
