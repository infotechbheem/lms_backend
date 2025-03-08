<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ISKCON Student Dashboard | Learning Managemtn System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('student-asset/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('student-asset/vendors/css/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="{{ asset('student-asset/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('student-asset/images/favicon.ico') }}" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container-scroller">

        @include('auth.student.layouts.modal-partial')
        @include('auth.student.layouts.header')
        <!-- partial -->
        @include('auth.student.layouts.navbar')

        <div class="container-fluid page-body-wrapper">

            @include('auth.student.layouts.sidebar')

            <!-- partial -->
            <div class="main-panel">

                @yield('main-section')

                <!-- content-wrapper ends -->
                @include('auth.student.layouts.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    {{-- script query for sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- base:js -->
    <script src="{{ asset('student-asset/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('student-asset/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('student-asset/js/jquery.cookie.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('student-asset/js/off-canvas.js') }}"></script>
    <script src="{{ asset('student-asset/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('student-asset/js/template.js') }}"></script>
    <script src="{{ asset('student-asset/js/settings.js') }}"></script>
    <script src="{{ asset('student-asset/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('student-asset/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->

    @include('auth.student.layouts.session-message')
    @include('auth.student.layouts.custom-js')

</body>

</html>
