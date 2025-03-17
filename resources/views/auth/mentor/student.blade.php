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
            <!-- Row for Course and Membership Cards -->
            <div class="row">
                <div class="card card-dashboard-pageviews">
                    <div class="card-body">
                        <div class="card-title">Student Details</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Student Id</th>
                                    <th>Student Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email Id</th>
                                    <th>Profile Picture</th>
                                    <th>Status</th>
                                    <th>Registration Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 + ($students->currentPage() - 1) * $students->perPage() }}</td>
                                    <td class="text-center">{{ $student->student_id }}</td>
                                    <td class="text-center">{{ $student->first_name . ' ' . $student->last_name }}</td>
                                    <td class="text-center">{{ $student->phone_number }}</td>
                                    <td class="text-center">{{ $student->email }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/'. $student->profile_picture) }}" alt="{{ $student->first_name }}" style="width: 50px; height:55px">
                                    </td>
                                    <td class="text-center">
                                        @if ($student->created_by)
                                        Registered By You
                                        @else
                                        Chooses as A Mentor
                                        @endif
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('mentor.student-profile-view', $student->student_id) }}" class="btn btn-sm btn-warning">View</a>
                                    </td>
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
                    @if($students->hasPages())
                    <div class="d-flex justify-content-between mt-3">
                        <!-- Pagination Text -->
                        <div class="pagination-text">
                            Showing
                            {{ ($students->currentPage() - 1) * $students->perPage() + 1 }}
                            to
                            {{ min($students->currentPage() * $students->perPage(), $students->total()) }}
                            of
                            {{ $students->total() }} results
                        </div>

                        <!-- Pagination Controls -->
                        <div class="pagination">
                            {{ $students->links('pagination::bootstrap-5') }} <!-- Bootstrap 5 pagination style -->
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- az-content-body -->
</div><!-- container -->
@endsection
