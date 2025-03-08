@extends('auth.admin.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance Department</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Holiday List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header" style="border: 1px solid green;">
                    <h5 class="m-0 p-0 text-left">Add Attendance</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Holiday List</th>
                                        <th>Date</th>
                                        <th>Created Date</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($holidays as $key => $holidayList)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $holidayList->holiday_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($holidayList->date)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($holidayList->created_at)->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.delete-holidays', $holidayList->id) }}" class="btn btn-sm btn-outline-danger delete-btn"><i class="fas fa-trash mr-1"></i>Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('admin.store-holidays') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Add Holiday Name</label>
                                    <input type="text" name="holiday_name" id="holiday_name" class="form-control" value="{{ old('holiday_name') }}" placeholder="Enter holiday Name">
                                    @error('holiday_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Add Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                                    @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-outline-primary mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
