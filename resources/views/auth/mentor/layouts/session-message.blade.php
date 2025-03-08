@if (session('failed'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error'
            , title: 'Oops...'
            , text: "{{ session('failed') }}"
            , showConfirmButton: true
            , confirmButtonText: 'OK',
            // timer: 2000 // Close alert after 2 seconds
        });
    });

</script>
@endif
@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error'
            , title: 'Oops...'
            , text: "{{ session('error') }}"
            , showConfirmButton: true
            , confirmButtonText: 'OK',
            // timer: 2000 // Close alert after 2 seconds
        });
    });

</script>
@endif
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success'
            , title: 'Welcome'
            , text: "{{ session('success') }}"
            , showConfirmButton: true
            , confirmButtonText: 'OK',
            // timer: 2000 // Close alert after 2 seconds
        });
    });

</script>
@endif
@if (session('warning'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'warning'
            , title: 'Sorry'
            , text: "{{ session('warning') }}"
            , showConfirmButton: true
            , confirmButtonText: 'OK',
            // timer: 2000 // Close alert after 2 seconds
        });
    });

</script>
@endif
