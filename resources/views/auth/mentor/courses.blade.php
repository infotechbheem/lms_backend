@extends('auth.mentor.layouts.app')

@section('main-section')

<div class="az-content az-content-dashboard">
    <div class="container">
        <div class="az-content-body">
            <!-- Row for Course and Membership Cards -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-dashboard-pageviews">
                        <div class="card-header">
                            <h6 class="card-title">All Course</h6>
                            <p class="card-text">Here are the show all course.</p>
                        </div><!-- card-header -->
                        <div class="card-body">
                            @foreach ($courses as $course)
                            <div class="az-list-item">
                                <div>
                                    <h6><a href="">{{ $course->course_title }}</a></h6>
                                    <span>/{{ $course->course_title }}/{{ $course->class_title }}</span>
                                </div>
                                <div>
                                    <h6 class="tx-primary">{{ $course->currency }} {{ number_format($course->discount_price,2) }}</h6>
                                    <span>Discount : 00.00</span>
                                </div>
                            </div><!-- list-group-item -->
                            @endforeach
                        </div><!-- card-body -->
                    </div><!-- card -->

                </div><!-- col -->
                <div class="col-lg-6">
                    <div class="card card-dashboard-pageviews">
                        <div class="card-header">
                            <h6 class="card-title">All Membership</h6>
                            <p class="card-text">Here are the show all Membership.</p>
                        </div><!-- card-header -->
                        <div class="card-body">
                            @foreach ($memberships as $membership)
                            <div class="az-list-item">
                                <div>
                                    <h6><a href="">{{ $membership->membership_name }}</a></h6>
                                    <span>/{{ $membership->description }}</span>
                                </div>
                                <div>
                                    <h6 class="tx-primary">{{ $membership->currency }} {{ number_format($membership->selling_price, 2) }}</h6>
                                    <span>Discount : {{ $membership->discount_price }}</span>
                                </div>
                            </div><!-- list-group-item -->
                            @endforeach
                        </div><!-- card-body -->
                    </div><!-- card -->

                </div><!-- col -->
            </div>

            <!-- Row for Charts -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h6 class="card-title">Course Enrollment Chart</h6>
                        </div><!-- card-header -->
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="chartPie" height="100" width="100"></canvas>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->

                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h6 class="card-title">Membership Subscription Chart</h6>
                        </div><!-- card-header -->
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="chartDonut"></canvas>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->

        </div><!-- az-content-body -->
    </div><!-- container -->
</div><!-- az-content -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie chart for course enrollment
    var ctxPie = document.getElementById('chartPie').getContext('2d');
    var chartPie = new Chart(ctxPie, {
        type: 'pie'
        , data: {
            labels: ['Math', 'Science', 'Literature', 'History'], // Replace with your dynamic data
            datasets: [{
                label: 'Courses Enrollment'
                , data: [30, 50, 40, 60], // Replace with dynamic enrollment data
                backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1']
                , borderColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1']
                , borderWidth: 1
            }]
        }
        , options: {
            responsive: true
            , plugins: {
                legend: {
                    position: 'top'
                , }
                , tooltip: {
                    enabled: true
                }
            }
        }
    });

    // Donut chart for membership subscription
    var ctxDonut = document.getElementById('chartDonut').getContext('2d');
    var chartDonut = new Chart(ctxDonut, {
        type: 'doughnut'
        , data: {
            labels: ['Basic', 'Premium', 'VIP'], // Replace with your dynamic data
            datasets: [{
                label: 'Membership Subscriptions'
                , data: [100, 200, 50], // Replace with dynamic subscription data
                backgroundColor: ['#FFB533', '#33B5FF', '#FF33B5']
                , borderColor: ['#FFB533', '#33B5FF', '#FF33B5']
                , borderWidth: 1
            }]
        }
        , options: {
            responsive: true
            , plugins: {
                legend: {
                    position: 'top'
                , }
                , tooltip: {
                    enabled: true
                }
            }
        }
    });

</script>

@endsection
