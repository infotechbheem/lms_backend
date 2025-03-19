<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ISKCON Volunteer Login | Learning Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('volunteer-asset/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('volunteer-asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('volunteer-asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('volunteer-asset/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('volunteer-asset/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('auth.volunteer.layouts.sidebar')


        <!-- Content Start -->
        <div class="content">

            @include('auth.volunteer.layouts.navbar')

            @yield('main-section')

            @include('auth.volunteer.layouts.footer')
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('volunteer-asset/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('volunteer-asset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('volunteer-asset/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('volunteer-asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('volunteer-asset/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('volunteer-asset/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('volunteer-asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('volunteer-asset/js/main.js') }}"></script>

    {{-- script query for sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('failed'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('failed') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    // timer: 2000 // Close alert after 2 seconds
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    // timer: 2000 // Close alert after 2 seconds
                });
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Welcome',
                    text: "{{ session('success') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    // timer: 2000 // Close alert after 2 seconds
                });
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sorry',
                    text: "{{ session('warning') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    // timer: 2000 // Close alert after 2 seconds
                });
            });
        </script>
    @endif

</body>

</html>
