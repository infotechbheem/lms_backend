@extends('auth.mentor.layouts.app')

@section('main-section')

<style>
    .table tr th,
    .table tr td {
        white-space: nowrap;
    }

</style>

<div class="az-content az-content-dashboard">
    <div class="container">
        <div class="az-content-body" style="width:100%">
            <div class="row">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="card-title">Calling Report Submit</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Student Id</th>
                                        <th>Student Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email Id</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $key => $student)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ fullName($student->first_name, $student->last_name) }}</td>
                                        <td>{{ $student->phone_number }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td class="text-center">
                                            <!-- Button to trigger the modal -->
                                            <button class="btn btn-primary updateResponseBtn" data-toggle="modal" data-target="#updateResponseModal" data-student-name="{{ fullName($student->first_name, $student->last_name) }}" data-student-id="{{ $student->student_id }}">
                                                Update Response
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                                    <th>Response</th>
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

            <div class="row">
                <div class="card card-dashboard-pageviews">
                    <div class="card-body">
                        <div class="card-title">Student Daily Sadhana Reports</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Student Name</th>
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
                                    <td class="text-center">{{ $sadhana_report->first_name . ' ' . $sadhana_report->last_name }}</td>
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

            </div>
        </div>
    </div><!-- az-content-body -->
</div><!-- container -->



<!-- Modal for updating response -->
<div class="modal fade" id="updateResponseModal" tabindex="-1" role="dialog" aria-labelledby="updateResponseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateResponseModalLabel">Update Calling Response</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mentor.submit-calling-response') }}" method="post">
                @csrf
                <input type="hidden" name="student_id" id="studentId">
                <div class="modal-body">
                    <!-- Form to Update Response -->
                    <div class="form-group">
                        <label for="studentName">Student Name</label>
                        <input type="text" class="form-control" id="studentName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="callingResponse">Calling Response</label>
                        <textarea class="form-control" id="callingResponse" name="calling_response" rows="5" placeholder="Enter your response..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Response</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Listen for the modal opening
    $(document).ready(function() {
        // When the "Update Response" button is clicked
        $('.updateResponseBtn').on('click', function() {
            var studentName = $(this).data('student-name'); // Get student name from data-* attribute
            var studentId = $(this).data('student-id'); // Get student ID from data-* attribute

            // Set the student name in the modal
            $('#studentName').val(studentName); // Set default name in input field

            // Optional: You could set a hidden field with student ID if needed
            $('#studentId').val(studentId); // If you need to send the student ID when the form is submitted
        });
    });

</script>

@endsection
