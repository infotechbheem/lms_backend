document.addEventListener('DOMContentLoaded', function () {
    // Attach a click event listener to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function (event) {
            // alert("clicked");
            event.preventDefault(); // Prevent the default link behavior

            // Use SweetAlert2 to show a confirmation dialog
            Swal.fire({
                title: 'Are you sure you want to proceed?',
                text: 'Once you delete this project, it will be permanently removed and cannot be recovered.!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = button.getAttribute('href');
                }
            });
        });
    });
});