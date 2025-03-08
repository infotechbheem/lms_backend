@extends('auth.admin.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Register Volunteer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <form action="{{ route('admin.store-volunteer') }}" method="post">
                        <div class="row justify-content-center">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Choose Mentor</label>
                                    <select name="volunteer_id" class="form-control select2" id="volunteer_id">
                                        <option value="">--------- Select ---------</option>
                                        @foreach ($students as $student)
                                        <option value="{{ $student->student_id }}">{{ $student->first_name . ' ' . $student->last_name . ' / ' . $student->student_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button style="margin-top:32px" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    All Mentor
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Voluneer Id </th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Addrss</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($volunteers as $key => $student)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
                                <td>{{ $student->phone_number }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->address ?? "Not Available" }}</td>
                                <td>
                                    <a href="{{ route ('admin.delete-volunteer', $student->student_id) }}" class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></a>
                                    <a href="" class="btn btn-primary"><i class="fas fa-folder"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
