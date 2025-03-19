<div class="az-header">
    <div class="container">
        <div class="az-header-left">
            <a href="index.html" class="az-logo">ISKCON LMS</a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="index.html" class="az-logo">ISKCON LMS</a>
                <a href="" class="close">&times;</a>
            </div><!-- az-header-menu-header -->
            <ul class="nav">
                <li class="nav-item {{ request()->routeIs('mentor.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('mentor.dashboard') }}" class="nav-link">Dashboard</a>
                </li>

                <li class="nav-item {{ request()->routeIs('mentor.courses') ? 'active' : '' }}">
                    <a href="{{ route('mentor.courses') }}" class="nav-link">Course</a>
                </li>

                <li class="nav-item {{ request()->routeIs('mentor.assignments') ? 'active' : '' }}">
                    <a href="" class="nav-link">Assignments</a>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('mentor.students') || request()->routeIs('mentor.student-profile-view') ? 'active' : '' }}">
                    <a href="{{ route('mentor.students') }}" class="nav-link">Students</a>
                </li>

                <li class="nav-item {{ request()->routeIs('mentor.reports') ? 'active' : '' }}">
                    <a href="{{ route('mentor.reports') }}" class="nav-link">Reports</a>
                </li>

                <li class="nav-item {{ request()->routeIs('mentor.settings') ? 'active' : '' }}">
                    <a href="" class="nav-link">Settings</a>
                </li>
            </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
            <div class="az-header-message">
                <a href="#"><i class="typcn typcn-messages"></i></a>
            </div><!-- az-header-message -->
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="{{ asset(showImage($mentor_profile_image)) }}"
                        alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img src="{{ asset(showImage($mentor_profile_image)) }}" alt="">
                        </div><!-- az-img-user -->
                        <h6>{{ auth()->user()->name }}</h6>
                        <span>Mentor</span>
                    </div><!-- az-header-profile -->

                    <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account
                        Settings</a>
                    <a href="{{ route('mentor.logout') }}" class="dropdown-item"><i
                            class="typcn typcn-power-outline"></i> Sign Out</a>
                </div><!-- dropdown-menu -->
            </div>
        </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->
