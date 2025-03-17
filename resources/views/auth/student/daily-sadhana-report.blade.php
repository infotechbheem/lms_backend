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

    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-primary">
                <div class="card-body">
                    <div class="card-title text-white">Temple Schedule</div>
                    <table class="table table-striped table-bordered custom-transparent-table">
                        <tr>
                            <th class="text-center text-white">Event</th>
                            <th class="text-center text-white">Time</th>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Mangla Arti</td>
                            <td class="text-center text-white">4:30 am</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Japa (Mantra) Meditation</td>
                            <td class="text-center text-white">5:15 am</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Darshan Arati</td>
                            <td class="text-center text-white">7:00 am</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Guru Puja</td>
                            <td class="text-center text-white">7:30 am</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Srimad Bhagavatam Discourse</td>
                            <td class="text-center text-white">8:00 am</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Raj Bhog Arati</td>
                            <td class="text-center text-white">12:30 pm</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Usthapana Arati</td>
                            <td class="text-center text-white">4:15 pm</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Sandhya Arati</td>
                            <td class="text-center text-white">6:30 pm</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Bhagavad Gita Discourse</td>
                            <td class="text-center text-white">8:00 pm</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Sayana Arati</td>
                            <td class="text-center text-white">8:30 pm</td>
                        </tr>
                        <tr>
                            <td class="text-center text-white">Temple Hall Closes</td>
                            <td class="text-center text-white">9:00 pm</td>
                        </tr>
                    </table>
                </div>
            </div>



        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-info">
                <div class="card-body">
                    <div>
                        <div class="card-title text-white text-center">
                            Submit Daily Report - <span id="current-date-time"></span>
                        </div>
                    </div>
                    <form action="{{ route('student.store-daily-sadhana-report') }}" method="post">
                        @csrf
                        <div class="row">
                            <!-- Wake Up Time -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="wake_up_time ">Wake Up Time</label>
                                    <input type="time" name="wake_up_time" id="wake_up_time" class="form-control">
                                </div>
                            </div>
                            <!-- Mangla Arti (Radio Buttons) -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="mangla_arti">Mangla Arti</label>
                                    <select name="mangla_arti" id="mangla_arti" class="form-control">
                                        <option>----------Select-------------</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Chanting Rounds before 9:00 AM -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="chanting_round_before_9_am">Chanting Rounds before 9:00 AM</label>
                                    <input type="number" name="chanting_round_before_9_am" id="chanting_round_before_9_am" class="form-control">
                                </div>
                            </div>
                            <!-- Chanting Rounds Between 9:00 AM - 9:00 PM -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="chanting_round_between_9_am_to_9_pm">Chanting Rounds Between 9:00 AM - 9:00 PM</label>
                                    <input type="number" name="chanting_round_between_9_am_to_9_pm" id="chanting_round_between_9_am_to_9_pm" class="form-control">
                                </div>
                            </div>
                            <!-- Chanting Rounds before 9:00 PM -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="chanting_round_after_9_pm">Chanting Rounds After 9:00 PM</label>
                                    <input type="number" name="chanting_round_after_9_pm" id="chanting_round_after_9_pm" class="form-control">
                                </div>
                            </div>
                            <!-- Hearing Duration (Hours and Minutes) -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="hearing_duration_hour">Hearing Duration</label>
                                    <div class="d-flex">
                                        <select name="hearing_duration_hour" id="hearing_duration_hour" class="form-control mr-2">
                                            <option value="">Hour</option>
                                            @for ($i = 0; $i <= 23; $i++) <option value="{{ $i }}">{{ $i }} hour</option>
                                                @endfor
                                        </select>
                                        <select name="hearing_duration_minute" id="hearing_duration_minute" class="form-control">
                                            <option value="">Minute</option>
                                            @for ($i = 0; $i <= 59; $i++) <option value="{{ $i }}">{{ $i }} min</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Reading Duration (Hours and Minutes) -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="reading_duration_hour">Reading Duration</label>
                                    <div class="d-flex">
                                        <select name="reading_duration_hour" id="reading_duration_hour" class="form-control mr-2">
                                            <option value="">Hour</option>
                                            @for ($i = 0; $i <= 23; $i++) <option value="{{ $i }}">{{ $i }} hour</option>
                                                @endfor
                                        </select>
                                        <select name="reading_duration_minute" id="reading_duration_minute" class="form-control">
                                            <option value="">Minute</option>
                                            @for ($i = 0; $i <= 59; $i++) <option value="{{ $i }}">{{ $i }} min</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Sleeping Time -->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="sleeping_time">Sleeping Time</label>
                                    <input type="time" name="sleeping_time" id="sleeping_time" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-lg btn-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Sadhna Report Daily wise --}}
    <div class="row grid-margin stretch-card">
        <div class="card profile-card bg-gradient-info">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered custom-transparent-table">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Wake Time</th>
                                <th>Mangla Arti</th>
                                <th>Chanting Round (Before 9 AM)</th>
                                <th>Chanting Round (After 9 )</th>
                                <th>Chanting Round ( 9 AM - 9 PM )</th>
                                <th>Hearing Duration</th>
                                <th>Reading Duration</th>
                                <th>Sleeping Time</th>
                                <th>Create At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $key => $report)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->wake_up_time)->format('h : i : A') }}</td>
                                <td>{{ str()->ucfirst($report->mangla_arti) }}</td>
                                <td>{{ number_format($report->chanting_round_before_9_am,0) }}</td>
                                <td>{{ number_format($report->chanting_round_after_9_pm,0) }}</td>
                                <td>{{ number_format($report->chanting_round_between_9_am_to_9_pm,0) }}</td>
                                <td>{{ $report->hearing_duration_hour }} : {{ $report->hearing_duration_minute }}</td>
                                <td>{{ $report->reading_duration_hour }} : {{ $report->reading_duration_minute }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->sleeping_time)->format('h : i : A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->created_at)->format('d-m-Y     h : i : A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function displayLiveDateTime() {
        // Get the current date and time
        var now = new Date();

        // Format the current time (e.g., "HH:MM:SS AM/PM")
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        // Get the current date (e.g., "Monday, March 13, 2025")
        var dayOfWeek = now.toLocaleString('default', {
            weekday: 'long'
        });
        var month = now.toLocaleString('default', {
            month: 'long'
        });
        var day = now.getDate();
        var year = now.getFullYear();

        // Combine the date and time
        var currentDate = dayOfWeek + ', ' + month + ' ' + day + ', ' + year;
        var currentTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;

        // Display the date and time together
        var currentDateTime = currentDate + ' - ' + currentTime;

        // Update the content of the span with the live date and time
        document.getElementById('current-date-time').textContent = currentDateTime;
    }

    // Call the function to display the date and time when the page loads
    window.onload = function() {
        displayLiveDateTime();
        setInterval(displayLiveDateTime, 1000); // Update every second
    };

</script>


@endsection
