@extends('auth.mentor.layouts.app')

@section('main-section')

<style>
    .card {
        border-radius: 5px;
    }

    .table tr th,
    .table tr td {
        white-space: nowrap;
    }

</style>

<div class="az-content az-content-dashboard">
    <div class="container">
        <div class="az-content-body" style="width:100%">
            <!-- Row for Course and Membership Cards -->
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Student Profile Image
                            </div>
                            <div class="card-body text-center p-0">
                                <img src="{{ asset('storage/'. $student->profile_picture) }}" alt="{{ $student->first_name }}" style="width: 60px; height: 60px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Student ID
                            </div>
                            <div class="card-body text-center">
                                {{ $student->student_id }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Mobile Number
                            </div>
                            <div class="card-body text-center">
                                {{ $student->phone_number }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Registration Date
                            </div>
                            <div class="card-body text-center">
                                {{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y h:i:A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 justify-content-center" style="gap: 30px">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="row p-2" style="border: 1px solid gray; border-radius: 3px;">
                        <div class="col-md-4">
                            <p><strong>First Name : </strong> {{ $student->first_name ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Last Name : </strong> {{ $student->last_name ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Date of Birth : </strong> {{ $student->date_of_birth  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-5">
                            <p><strong>Email : </strong> {{ $student->email  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Gender : </strong> {{ $student->gender  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Mobile Number : </strong> {{ $student->phone_number  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Address : </strong> {{ $student->city  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>City : </strong> {{ $student->city  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>State : </strong> {{ $student->state  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Zip Code : </strong> {{ $student->zip_code  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-2">
                            <p><strong>Country : </strong> {{ $student->country  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-5">
                            <p><strong>Emergency Mobile Number : </strong> {{ $student->emergency_contact_phone  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-5">
                            <p><strong>Emergency Email Id : </strong> {{ $student->emergency_contact_email  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Occupation : </strong> {{ $student->occupation  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Annual Income : </strong> {{ $student->annual_income  ?? "N/A" }} </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Registration Date : </strong> {{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y')  ?? "N/A" }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="row p-2" style="border: 1px solid gray; border-radius: 2px">
                        <div class="col-md-12">
                            <p><strong>Course Name :</strong> {{ getCourseName($student->course_id) }}</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Membership Name :</strong> {{ getMembership($student->membership_id) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="mt-2">Sadhna Report</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Wake Up time</th>
                                <th>Mangla Arti</th>
                                <th>Chanting Round Before 9 AM</th>
                                <th>Chanting Round After 9 PM</th>
                                <th>Chanting Round (9 AM - 9 PM)</th>
                                <th>Hearing Duration Time</th>
                                <th>Reading Duration Time</th>
                                <th>Sleeping Time</th>
                                <th>Created Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sadhana_reports as $key => $sadhana_report)
                            <tr>
                                <td>{{ $key + 1 + ($sadhana_reports->currentPage() - 1) * $sadhana_reports->perPage() }}</td>
                                <td class="text-center">{{ formatTime($sadhana_report->wake_up_time) }}</td>
                                <td class="text-center">{{ str()->ucfirst($sadhana_report->mangla_arti) }}</td>
                                <td class="text-center">{{ number_format($sadhana_report->chanting_round_before_9_am,0) }}</td>
                                <td class="text-center">{{ number_format($sadhana_report->chanting_round_after_9_pm,0) }}</td>
                                <td class="text-center">{{ number_format($sadhana_report->chanting_round_between_9_am_to_9_pm,0) }}</td>
                                <td class="text-center">{{ $sadhana_report->hearing_duration_hour }} H : {{ $sadhana_report->hearing_duration_minute }} M</td>
                                <td class="text-center">{{ $sadhana_report->reading_duration_hour }} H : {{ $sadhana_report->reading_duration_minute }} M</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($sadhana_report->sleeping_time)->format('h : i : A') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($sadhana_report->created_at)->format('d-m-Y     h : i : A') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center">No Data Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Controls at the Bottom -->
                @if($sadhana_reports->hasPages())
                <div class="d-flex justify-content-between mt-3">
                    <!-- Pagination Text -->
                    <div class="pagination-text">
                        Showing
                        {{ ($sadhana_reports->currentPage() - 1) * $sadhana_reports->perPage() + 1 }}
                        to
                        {{ min($sadhana_reports->currentPage() * $sadhana_reports->perPage(), $sadhana_reports->total()) }}
                        of
                        {{ $sadhana_reports->total() }} results
                    </div>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        {{ $sadhana_reports->links('pagination::bootstrap-5') }} <!-- Bootstrap 5 pagination style -->
                    </div>
                </div>
                @endif
            </div>


            <div class="row">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="card-title">Calling Student Response</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th class="text-center">Student Id</th>
                                    <th class="text-center">Student Name</th>
                                    <th class="text-center">Mobile Number</th>
                                    <th class="text-center">Response</th>
                                    <th class="text-center">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($calling_response as $key => $response)
                                <tr>
                                    <td>{{ $key + 1 + ($calling_response->currentPage() - 1) * $calling_response->perPage() }}</td>
                                    <td class="text-center">{{ $response->student_id }}</td>
                                    <td class="text-center">{{ $response->first_name . ' ' . $response->last_name }}</td>
                                    <td class="text-center">{{ $response->phone_number }}</td>
                                    <td style="white-space: wrap">{{ $response->response }}</td>
                                    <td class="text-center">{{ formatDateAndTime($response->created_at) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Controls at the Bottom -->
                    @if($calling_response->hasPages())
                    <div class="d-flex justify-content-between mt-3">
                        <!-- Pagination Text -->
                        <div class="pagination-text">
                            Showing
                            {{ ($calling_response->currentPage() - 1) * $calling_response->perPage() + 1 }}
                            to
                            {{ min($calling_response->currentPage() * $calling_response->perPage(), $calling_response->total()) }}
                            of
                            {{ $calling_response->total() }} results
                        </div>

                        <!-- Pagination Controls -->
                        <div class="pagination">
                            {{ $calling_response->links('pagination::bootstrap-5') }} <!-- Bootstrap 5 pagination style -->
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div><!-- az-content-body -->
</div><!-- container -->
@endsection
