@extends('auth.mentor.layouts.app')

@section('main-section')

<div class="az-content az-content-dashboard">
    <div class="container">
        <div class="az-content-body">
            <div class="az-dashboard-one-title">
                <div>
                    <h2 class="az-dashboard-title">Hi, welcome back, Mentor!</h2>
                    <p class="az-dashboard-text">Your Learning Management System dashboard.</p>
                </div>
                <div class="az-content-header-right">
                    <div class="media">
                        <div class="media-body">
                            <label>Start Date</label>
                            <h6>Jan 1, 2025</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                        <div class="media-body">
                            <label>End Date</label>
                            <h6>Jan 31, 2025</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                        <div class="media-body">
                            <label>Event Category</label>
                            <h6>All Categories</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <a href="" class="btn btn-purple">Export</a>
                </div>
            </div><!-- az-dashboard-one-title -->

            <div class="az-dashboard-nav">
                <nav class="nav">
                    <a class="nav-link active" data-toggle="tab" href="#overview">Overview</a>
                    <a class="nav-link" data-toggle="tab" href="#all-registered-students">All Registered Students</a>
                    <a class="nav-link" data-toggle="tab" href="#student-registration">Student Registration</a>
                </nav>

                <nav class="nav">
                    <a class="nav-link" href="#"><i class="far fa-save"></i> Save Report</a>
                    <a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Export to PDF</a>
                    <a class="nav-link" href="#"><i class="far fa-envelope"></i> Send to Email</a>
                    <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
                </nav>
            </div>

            <div class="tab-content">
                <!-- Overview Tab -->
                <div class="tab-pane active" id="overview">
                    <div class="row row-sm mg-b-20">
                        <div class="col-lg-12 ht-lg-100p">
                            <div class="card card-dashboard-one">
                                <div class="card-header">
                                    <div>
                                        <h6 class="card-title">Student Registration Metrics</h6>
                                        <p class="card-text">Metrics of students who have registered within the current date range.</p>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn active">Day</button>
                                        <button class="btn">Week</button>
                                        <button class="btn">Month</button>
                                    </div>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <div>
                                            <label class="mg-b-0">Total Registered Students</label>
                                            <h2>{{ number_format($noOfStudent, 0) }}</h2>
                                        </div>
                                        <div>
                                            <label class="mg-b-0">Today Registration</label>
                                            <h2>{{ number_format($noOfStudentToday,0) }}</h2>
                                        </div>
                                        <div>
                                            <label class="mg-b-0">Yesterday Registration</label>
                                            <h2>{{ number_format($noOfStudentYesterday,0) }}</h2>
                                        </div>
                                        <div>
                                            <label class="mg-b-0">This Month Registration</label>
                                            <h2>{{ number_format($noOfStudentThisMonth,0) }}</h2>
                                        </div>
                                    </div><!-- card-body-top -->
                                    <div class="flot-chart-wrapper">
                                        <div id="flotChart" class="flot-chart"></div>
                                    </div><!-- flot-chart-wrapper -->
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                    </div><!-- row -->
                </div>

                <!-- All Registered Students Tab -->
                <div class="tab-pane" id="all-registered-students">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>All Registered Students</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Course Enroll</th>
                                        <th>Membership Enroll</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ fullName($student->first_name, $student->last_name) }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td><span class="badge rounded-pill bg-primary text-white">{{ getNumberOfCourse($student->course_id) }}</span></td>
                                        <td><span class="badge rounded-pill bg-success text-white">{{ getNumberOfCourse($student->membership_id) }}</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">View</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Student Registration Tab -->
                <div class="tab-pane" id="student-registration">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>New Student Registration</h3>
                            <form action="{{ route('mentor.store-student-registration') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" required>
                                            <span class="text-danger" id="email-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Mobile Number</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control">
                                            <span class="text-danger" id="phone_number-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Date of Birth</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Select Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <textarea name="address" id="address" rows="1" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" name="city" id="city" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="text" name="state" id="state" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Zip Code</label>
                                            <input type="text" name="zip_code" id="zip_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <input type="text" name="country" id="country" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Emergency Contact Number</label>
                                            <input type="text" name="emergency_contact_number" id="emergency_contact_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Emergency Contact Email</label>
                                            <input type="text" name="emergency_contact_email" id="emergency_contact_email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Occupation</label>
                                            <input type="text" name="occupation" id="occupation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Annual Income</label>
                                            <input type="text" name="annual_income" id="annual_income" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Upload Profile Picture</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Course</label>
                                            <select name="course[]" id="course" class="form-control" multiple>
                                                <option value="">Select Course</option>
                                                @foreach($courses as $course)
                                                <option value="{{$course->id }}">{{ $course->course_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Membership</label>
                                            <select name="membership[]" id="membership" class="form-control" multiple>
                                                <option value="">Select Membership</option>
                                                @foreach($memberships as $membership)
                                                <option value="{{$membership->membership_id }}">{{ $membership->membership_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mb-4">Register Student</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- tab-content -->

            <div class="row row-sm mg-b-20">
                <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                    <div class="row row-sm">
                        <div class="col-sm-6">
                            <div class="card card-dashboard-two">
                                <div class="card-header">
                                    <h6><i class="icon ion-md-trending-up tx-success"></i> <small>18.02%</small></h6>
                                    <p>Pending Approvals</p>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="chart-wrapper">
                                        <div id="flotChart1" class="flot-chart"></div>
                                    </div><!-- chart-wrapper -->
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                        <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                            <div class="card card-dashboard-two">
                                <div class="card-header">
                                    <h6>{{ number_format($noOfStudent, 2) }} <i class="icon ion-md-trending-down tx-danger"></i> <small>0.86%</small></h6>
                                    <p>Total Registered Students</p>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="chart-wrapper">
                                        <div id="flotChart2" class="flot-chart"></div>
                                    </div><!-- chart-wrapper -->
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                        <div class="col-sm-12 mg-t-20">
                            <div class="card card-dashboard-three">
                                <div class="card-header">
                                    <p>Total Sessions by Students</p>
                                    <h6>16,869 <small class="tx-success"><i class="icon ion-md-arrow-up"></i> 2.87%</small></h6>
                                    <small>Total number of active sessions for the registered students during the selected period.</small>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="chart"><canvas id="chartBar5"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- row -->
                </div>
                <div class="col-lg-6">
                    <div class="card card-dashboard-pageviews">
                        <div class="card-header">
                            <h6 class="card-title">Student Registrations by Course</h6>
                            <p class="card-text">This report shows the number of registrations per course within the selected period.</p>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <div class="az-list-item">
                                <div>
                                    <h6>Course A</h6>
                                    <span>/courses/course-a</span>
                                </div>
                                <div>
                                    <h6 class="tx-primary">500</h6>
                                    <span>30.49%</span>
                                </div>
                            </div><!-- list-group-item -->
                            <div class="az-list-item">
                                <div>
                                    <h6>Course B</h6>
                                    <span>/courses/course-b</span>
                                </div>
                                <div>
                                    <h6 class="tx-primary">450</h6>
                                    <span>27.45%</span>
                                </div>
                            </div><!-- list-group-item -->
                            <div class="az-list-item">
                                <div>
                                    <h6>Course C</h6>
                                    <span>/courses/course-c</span>
                                </div>
                                <div>
                                    <h6 class="tx-primary">280</h6>
                                    <span>17.63%</span>
                                </div>
                            </div><!-- list-group-item -->
                            <div class="az-list-item">
                                <div>
                                    <h6>Course D</h6>
                                    <span>/courses/course-d</span>
                                </div>
                                <div>
                                    <h6 class="tx-primary">180</h6>
                                    <span>11.27%</span>
                                </div>
                            </div><!-- list-group-item -->
                            <div class="az-list-item">
                                <div>
                                    <h6>Course D</h6>
                                    <span>/courses/course-d</span>
                                </div>
                                <div>
                                    <h6 class="tx-primary">180</h6>
                                    <span>11.27%</span>
                                </div>
                            </div><!-- list-group-item -->
                        </div><!-- card-body -->
                    </div><!-- card -->

                </div><!-- col -->
                <!--col -->
            </div><!-- row -->

            <div class="row row-sm mg-b-20">
                <div class="col-lg-8 mg-t-20 mg-lg-t-0">
                    <div class="card card-dashboard-four">
                        <div class="card-header">
                            <h6 class="card-title">Monthly Registrations Overview</h6>
                        </div><!-- card-header -->
                        <div class="card-body row">
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="chart"><canvas id="chartDonut"></canvas></div>
                            </div><!-- col -->
                            <div class="col-md-6 col-lg-5 mg-lg-l-auto mg-t-20 mg-md-t-0">
                                <div class="az-traffic-detail-item">
                                    <div>
                                        <span>January</span>
                                        <span>500 <span>(40%)</span></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-purple wd-40p" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><!-- progress -->
                                </div>
                                <div class="az-traffic-detail-item">
                                    <div>
                                        <span>February</span>
                                        <span>380 <span>(31%)</span></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary wd-31p" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><!-- progress -->
                                </div>
                                <div class="az-traffic-detail-item">
                                    <div>
                                        <span>March</span>
                                        <span>250 <span>(20%)</span></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-info wd-20p" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><!-- progress -->
                                </div>
                                <div class="az-traffic-detail-item">
                                    <div>
                                        <span>April</span>
                                        <span>100 <span>(8%)</span></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-teal wd-8p" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><!-- progress -->
                                </div>
                            </div><!-- col -->
                        </div><!-- card-body -->
                    </div><!-- card-dashboard-four -->
                </div><!-- col -->
                <div class="col-lg-5 col-xl-4">
                    <div class="row row-sm">
                        <div class="col-md-6 col-lg-12 mg-b-20 mg-md-b-0 mg-lg-b-20">
                            <div class="card card-dashboard-five">
                                <div class="card-header">
                                    <h6 class="card-title">Student Acquisition</h6>
                                    <span class="card-text">Tells you where your students originated from, such as search engines, social media, or referrals.</span>
                                </div><!-- card-header -->
                                <div class="card-body row row-sm">
                                    <div class="col-6 d-sm-flex align-items-center">
                                        <div class="card-chart bg-primary">
                                            <span class="peity-bar" data-peity='{"fill": ["#fff"], "width": 20, "height": 20 }'>6,4,7,5,7</span>
                                        </div>
                                        <div>
                                            <label>New Students</label>
                                            <h4>800</h4>
                                        </div>
                                    </div><!-- col -->
                                    <div class="col-6 d-sm-flex align-items-center">
                                        <div class="card-chart bg-purple">
                                            <span class="peity-bar" data-peity='{"fill": ["#fff"], "width": 21, "height": 20 }'>7,4,5,7,2</span>
                                        </div>
                                        <div>
                                            <label>Returning Students</label>
                                            <h4>430</h4>
                                        </div>
                                    </div><!-- col -->
                                </div><!-- card-body -->
                            </div><!-- card-dashboard-five -->
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- col-lg-3 -->
            </div><!-- row -->

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $("document").ready(function() {
        // Your chart code here...
        $('#email').on('change', function(event) {
            event.preventDefault();
            var email = $('#email').val(); // Fixed the selector here
            $.ajax({
                url: "{{route('check-email-availability')}}"
                , method: "POST"
                , data: {
                    email: email
                }, // No need for redundant 'data: email'
                success: function(response) {
                    if (response.status) {
                        $('#email-error').text(response.message);
                    } else {
                        $('#email-error').text('');
                    }
                }
                , error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
        // Your chart code here...
        $('#phone_number').on('change', function(event) {
            event.preventDefault();
            var phone_number = $('#phone_number').val(); // Fixed the selector here
            $.ajax({
                url: "{{route('check-phone_number-availability')}}"
                , method: "POST"
                , data: {
                    phone_number: phone_number
                }, // No need for redundant 'data: email'
                success: function(response) {
                    if (response.status) {
                        $('#phone_number-error').text(response.message);
                    } else {
                        $('#phone_number-error').text('');
                    }
                }
                , error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

</script>
<script>
    $(function() {
        'use strict'

        var plot = $.plot('#flotChart', [{
            data: flotSampleData3
            , color: '#007bff'
            , lines: {
                fillColor: {
                    colors: [{
                        opacity: 0
                    }, {
                        opacity: 0.2
                    }]
                }
            }
        }, {
            data: flotSampleData4
            , color: '#560bd0'
            , lines: {
                fillColor: {
                    colors: [{
                        opacity: 0
                    }, {
                        opacity: 0.2
                    }]
                }
            }
        }], {
            series: {
                shadowSize: 0
                , lines: {
                    show: true
                    , lineWidth: 2
                    , fill: true
                }
            }
            , grid: {
                borderWidth: 0
                , labelMargin: 8
            }
            , yaxis: {
                show: true
                , min: 0
                , max: 100
                , ticks: [
                    [0, '']
                    , [20, '20K']
                    , [40, '40K']
                    , [60, '60K']
                    , [80, '80K']
                ]
                , tickColor: '#eee'
            }
            , xaxis: {
                show: true
                , color: '#fff'
                , ticks: [
                    [25, 'OCT 21']
                    , [75, 'OCT 22']
                    , [100, 'OCT 23']
                    , [125, 'OCT 24']
                ]
            , }
        });

        $.plot('#flotChart1', [{
            data: dashData2
            , color: '#00cccc'
        }], {
            series: {
                shadowSize: 0
                , lines: {
                    show: true
                    , lineWidth: 2
                    , fill: true
                    , fillColor: {
                        colors: [{
                            opacity: 0.2
                        }, {
                            opacity: 0.2
                        }]
                    }
                }
            }
            , grid: {
                borderWidth: 0
                , labelMargin: 0
            }
            , yaxis: {
                show: false
                , min: 0
                , max: 35
            }
            , xaxis: {
                show: false
                , max: 50
            }
        });

        $.plot('#flotChart2', [{
            data: dashData2
            , color: '#007bff'
        }], {
            series: {
                shadowSize: 0
                , bars: {
                    show: true
                    , lineWidth: 0
                    , fill: 1
                    , barWidth: .5
                }
            }
            , grid: {
                borderWidth: 0
                , labelMargin: 0
            }
            , yaxis: {
                show: false
                , min: 0
                , max: 35
            }
            , xaxis: {
                show: false
                , max: 20
            }
        });


        //-------------------------------------------------------------//


        // Line chart
        $('.peity-line').peity('line');

        // Bar charts
        $('.peity-bar').peity('bar');

        // Bar charts
        $('.peity-donut').peity('donut');

        var ctx5 = document.getElementById('chartBar5').getContext('2d');
        new Chart(ctx5, {
            type: 'bar'
            , data: {
                labels: [0, 1, 2, 3, 4, 5, 6, 7]
                , datasets: [{
                    data: [2, 4, 10, 20, 45, 40, 35, 18]
                    , backgroundColor: '#560bd0'
                }, {
                    data: [3, 6, 15, 35, 50, 45, 35, 25]
                    , backgroundColor: '#cad0e8'
                }]
            }
            , options: {
                maintainAspectRatio: false
                , tooltips: {
                    enabled: false
                }
                , legend: {
                    display: false
                    , labels: {
                        display: false
                    }
                }
                , scales: {
                    yAxes: [{
                        display: false
                        , ticks: {
                            beginAtZero: true
                            , fontSize: 11
                            , max: 80
                        }
                    }]
                    , xAxes: [{
                        barPercentage: 0.6
                        , gridLines: {
                            color: 'rgba(0,0,0,0.08)'
                        }
                        , ticks: {
                            beginAtZero: true
                            , fontSize: 11
                            , display: false
                        }
                    }]
                }
            }
        });

        // Donut Chart
        var datapie = {
            labels: ['Search', 'Email', 'Referral', 'Social', 'Other']
            , datasets: [{
                data: [25, 20, 30, 15, 10]
                , backgroundColor: ['#6f42c1', '#007bff', '#17a2b8', '#00cccc', '#adb2bd']
            }]
        };

        var optionpie = {
            maintainAspectRatio: false
            , responsive: true
            , legend: {
                display: false
            , }
            , animation: {
                animateScale: true
                , animateRotate: true
            }
        };

        // For a doughnut chart
        var ctxpie = document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
            type: 'doughnut'
            , data: datapie
            , options: optionpie
        });

    });

</script>


@endsection
