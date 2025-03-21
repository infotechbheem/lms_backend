    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand brand-logo" href="index.html"><img src="https://iskcondwarka.org/corona-relief/img/logo.png" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="https://iskcondwarka.org/corona-relief/img/logo.png" alt="logo" /></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav me-lg-2">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        @if (isset($student->profile_picture))
                        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="profile" />
                        @else
                        <img src="{{ asset('student-asset/images/faces/face1.jpg') }}" alt="profile" />
                        @endif


                        <span class="nav-profile-name">{{ $student->first_name . ' ' . $student->last_name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <!-- Profile Section -->
                        <a class="dropdown-item" href="{{ route('student.profile') }}">
                            <i class="typcn typcn-user-outline text-primary"></i>
                            Profile
                        </a>

                        <!-- Change Password Section -->
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePassword">
                            <i class="typcn typcn-key-outline text-primary"></i>
                            Change Password
                        </a>

                        <!-- Logout Section -->
                        <a class="dropdown-item" href="#">
                            <i class="typcn typcn-power-outline text-primary"></i>
                            Logout
                        </a>
                    </div>

                </li>
                <li class="nav-item nav-user-status dropdown">
                    <p class="mb-0">Last login was 23 hours ago.</p>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-date dropdown">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                        <h6 class="date mb-0">Today : Mar 23</h6>
                        <i class="typcn typcn-calendar"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="typcn typcn-mail mx-0"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                        <p class="mb-0 fw-normal float-start dropdown-header">Messages</p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('student-asset/images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis fw-normal">David Grey
                                </h6>
                                <p class="fw-light small-text text-muted mb-0">
                                    The meeting is cancelled
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('student-asset/images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis fw-normal">Tim Cook
                                </h6>
                                <p class="fw-light small-text text-muted mb-0">
                                    New product launch
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('student-asset/images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis fw-normal"> Johnson
                                </h6>
                                <p class="fw-light small-text text-muted mb-0">
                                    Upcoming board meeting
                                </p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown me-0">
                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="typcn typcn-bell mx-0"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <p class="mb-0 fw-normal float-start dropdown-header">Notifications</p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="typcn typcn-info mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal">Application Error</h6>
                                <p class="fw-light small-text mb-0 text-muted">
                                    Just now
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="typcn typcn-cog-outline mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal">Settings</h6>
                                <p class="fw-light small-text mb-0 text-muted">
                                    Private message
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="typcn typcn-user mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal">New user registration</h6>
                                <p class="fw-light small-text mb-0 text-muted">
                                    2 days ago
                                </p>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="typcn typcn-th-menu"></span>
            </button>
        </div>
    </nav>
