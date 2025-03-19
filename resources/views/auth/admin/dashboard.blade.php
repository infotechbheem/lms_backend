@extends('auth.admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($totalStudentRegistered, 0) }}</h3>
                                <p>Total Studend Registered</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format($totalMemtorEnrolled, 0) }}</h3>
                                <p>Total Mentor enrolled</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($totalVolunteerEnrolled, 0) }}</h3>
                                <p>total Volunteer enrolled</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ number_format($totalCourseUpdated, 0) }}</h3>
                                <p>Total Courses updated</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">

                    <div class="row">
                        <div class="col-12 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="m-0">Isckon Learning Management System</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Attendance Management -->
                                    <h4>1. Attendance Management</h4>
                                    <ul>
                                        <li>Real-time tracking of employee, volunteer, and beneficiary attendance.</li>
                                        <li>Automatic logging of attendance through sign-ins and sign-outs.</li>
                                        <li>Track absenteeism, tardiness, and leave records to ensure punctuality.</li>
                                        <li>Monitor attendance patterns to adjust resources and project scheduling.</li>
                                        <li>Generate attendance reports for audits, payroll, and performance reviews.</li>
                                    </ul>
                                    <p>Attendance Management ensures that all employees, volunteers, and beneficiaries are
                                        held accountable for their time, making it easier for NGOs to track the productivity
                                        and involvement of staff. This system streamlines attendance recording and can
                                        automatically flag issues such as absenteeism or tardiness. Attendance data is
                                        crucial for managing payroll, resource allocation, and performance evaluations
                                        within the NGO.</p>

                                    <!-- Volunteer Management -->
                                    <h4>2. Volunteer Management</h4>
                                    <ul>
                                        <li>Store detailed records of volunteers, including hours worked, skills, and
                                            certifications.</li>
                                        <li>Track volunteer engagement and participation in various NGO programs and events.
                                        </li>
                                        <li>Assign volunteers to specific tasks based on their skills and interests.</li>
                                        <li>Monitor volunteer performance, feedback, and overall impact on NGO initiatives.
                                        </li>
                                        <li>Generate reports to assess volunteer contributions and program effectiveness.
                                        </li>
                                    </ul>
                                    <p>Volunteer Management allows the NGO to maintain detailed records of all its
                                        volunteers, including their participation in specific programs. This feature helps
                                        in ensuring that the right volunteers are matched to appropriate tasks. It also
                                        provides insight into the effectiveness of the volunteer workforce, improving future
                                        program planning and volunteer recruitment efforts. With performance tracking, NGOs
                                        can ensure that volunteers are contributing meaningfully to their causes.</p>

                                </div>
                            </div>
                        </div>


                        <section class="col-lg-12 connectedSortable">
                            <!-- Calendar -->
                            <div class="card bg-gradient-success">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Calendar
                                    </h3>
                                    <!-- tools card -->
                                    <div class="card-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="#" class="dropdown-item">Add new event</a>
                                                <a href="#" class="dropdown-item">Clear events</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item">View calendar</a>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pt-0">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%; height;"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
