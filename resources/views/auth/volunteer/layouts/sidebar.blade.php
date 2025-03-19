<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><img class="mr-2"
                    src="https://www.iskcondelhi.com/wp-content/uploads/2024/01/iskcon-delhi-new-logo-1.png"
                    alt="" style="width:50px;">ISKCON LMS</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset(showImage($volunteer->profile_picture)) }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ fullName($volunteer->first_name, $volunteer->last_name) }}</h6>
                <span>Volunteer</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('volunteer.dashboard') }}"
                class="nav-item nav-link {{ request()->routeIs('volunteer.dashboard') ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('volunteer.student-registration') }}"
                class="nav-item nav-link {{ request()->routeIs('volunteer.student-registration') ? 'active' : '' }} "><i
                    class="fa fa-th me-2"></i>Student Registration</a>
            <a href="{{ route('volunteer.all-registered-student') }}"
                class="nav-item nav-link {{ request()->routeIs('volunteer.all-registered-student') ? 'active' : '' }}"><i
                    class="fa fa-keyboard me-2"></i>Registered Student</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
