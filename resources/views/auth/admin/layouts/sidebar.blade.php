<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="https://www.iskcon.org/img/Iskconlogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light">ISCKON LMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-asset/dist/img/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="Image">
            </div>
            <div class="info">
                <a href="" class="d-block">Admin</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard Section -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? "active" : "" }} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Lavels / Membership -->
                <li class="nav-header">Lavel / Membership</li>
                <li class="nav-item">
                    <a href="{{ route('admin.create-courses') }}" class="nav-link {{ request()->routeIs('admin.create-courses') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Create Courses</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.created-course') }}" class="nav-link {{ request()->routeIs('admin.created-course') || request()->routeIs('admin.view-course-details') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Created Course</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.create-membership') ? "active" : "" }}">
                    <a href="{{ route('admin.create-membership') }}" class="nav-link {{ request()->routeIs('admin.create-membership') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Create Membership</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.all-membership') ? "active" : "" }}">
                    <a href="{{ route('admin.all-membership') }}" class="nav-link {{ request()->routeIs('admin.all-membership') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>All Membership</p>
                    </a>
                </li>
                <!-- Student Area -->
                <li class="nav-header">Student Area</li>
                <li class="nav-item">
                    <a href="{{ route('admin.student') }}" class="nav-link {{ request()->routeIs('admin.student') || request()->routeIs('admin.view-student-profile') || request()->routeIs('admin.update-student-details') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mentor-allotment') }}" class="nav-link {{ request()->routeIs('admin.mentor-allotment') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Mentor Allot</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.calling-student-response-update') }}" class="nav-link {{ request()->routeIs('admin.calling-student-response-update') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Calling Student</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.student-class-reminder') }}" class="nav-link {{ request()->routeIs('admin.student-class-reminder') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Class Reminder</p>
                    </a>
                </li>

                <!-- Student Attendance Area -->
                <li class="nav-header text-white">Attendance Management</li>
                <li class="nav-item">
                    <a href="{{ route('admin.add-attendance') }}" class="nav-link {{ request()->routeIs('admin.add-attendance')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-check"></i> <!-- Add Attendance Icon -->
                        <p>Add Attendance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.view-attendance') }}" class="nav-link {{ request()->routeIs('admin.view-attendance')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-eye"></i> <!-- View Attendance Icon -->
                        <p>View Attendance</p>
                    </a>
                </li>


                <!-- Online live class -->
                <li class="nav-header">Live Workshop</li>
                <li class="nav-item">
                    <a href="{{ route('admin.create-live-work-shop') }}" class="nav-link {{ request()->routeIs('admin.create-live-work-shop') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Create Live Workshop</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.created-meetings') }}" class="nav-link {{ request()->routeIs('admin.created-meetings') || request()->routeIs('admin.get-metting-details') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Created Meetings</p>
                    </a>
                </li>

                <!-- Recorded Courses -->
                <li class="nav-header">Recorded Courses</li>
                <li class="nav-item">
                    <a href="{{ route('admin.add-recording') }}" class="nav-link {{ request()->routeIs('admin.add-recording') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Add Recording</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.add-assignments') }}" class="nav-link {{ request()->routeIs('admin.add-assignments') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Add Assignments</p>
                    </a>
                </li>

                <!-- Volunteer Area -->
                <li class="nav-header">Volunteer Area</li>
                <li class="nav-item">
                    <a href="{{ route('admin.register-volunteer') }}" class="nav-link {{ request()->routeIs('admin.register-volunteer') ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Register Volunteer</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
