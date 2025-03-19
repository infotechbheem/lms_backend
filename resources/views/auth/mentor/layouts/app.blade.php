<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-90680653-2');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title>INKCON Mentor Dashboard | Learning Management</title>
    <!-- vendor css -->
    <link href="{{ asset('mentor-asset/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mentor-asset/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mentor-asset/lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('mentor-asset/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="{{ asset('mentor-asset/css/azia.css') }}">

</head>

<body>

    @include('auth.mentor.layouts.header')

    @yield('main-section')

    @include('auth.mentor.layouts.footer')

    {{-- script query for sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('mentor-asset/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('mentor-asset/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('mentor-asset/lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('mentor-asset/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('mentor-asset/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('mentor-asset/lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('mentor-asset/lib/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('mentor-asset/js/azia.js') }}"></script>
    <script src="{{ asset('mentor-asset/js/chart.flot.sampledata.js') }}"></script>
    <script src="{{ asset('mentor-asset/js/dashboard.sampledata.js') }}"></script>
    @include('auth.mentor.layouts.session-message')

</body>

</html>
