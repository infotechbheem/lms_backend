@extends('auth.volunteer.layouts.app')

@section('main-section')
    <div class="container-fluid">
        <div class="bg-light rounded p-4 shadow-lg">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Student Id</th>
                        <th>Student Name</th>
                        <th>Mobile Number</th>
                        <th>Email Id</th>
                        <th>Gender</th>
                        <th>Profile Image</th>
                        <th>Create Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $key => $student)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ fullName($student->first_name, $student->last_name) }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>
                                <img src="{{ asset(showImage($student->profile_picture)) }}" style="width: 70px"
                                    alt="{{ $student->first_name }}">
                            </td>
                            <td>
                                @if ($student->created_at->isToday())
                                    {{ $student->created_at->diffForHumans() }} ago
                                @else
                                    {{ $student->created_at->format('d-M-Y') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('volunteer.view-student-details', $student->encrypted_id) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
