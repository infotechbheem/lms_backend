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
                                    <th>S.N.</th>
                                    <th>Course Title</th>
                                    <th>Class Title</th>
                                    <th>Class Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($classes) && count($classes) > 0)
                                @foreach($classes as $key => $class)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <!-- Accessing course_title on the course model -->
                                    <td>{{ $class['course']->course_title }}</td>
                                    <td>{{ $class['course']->class_title }}</td>
                                    <td>{{ $class['course']->class_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($class['course']->start_date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($class['course']->end_date)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('student.view-recorded-class', $class['encrypted_id']) }}" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-center">No classes found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
