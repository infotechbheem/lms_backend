<script>
    $(document).ready(function() {

        // Listen for click event on the "Change Password" button
        $("#submitChangePasswordBtn").on('click', function(event) {
            event.preventDefault();

            // Get values of the old password, new password, and confirm password fields
            var currentPassword = $("#oldPassword").val();
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();

            // Validate the input fields (Optional but recommended)
            if (newPassword !== confirmPassword) {
                alert("New password and confirm password do not match.");
                return;
            }

            // Create an object to hold the data to send in the request
            var data = {
                old_password: currentPassword
                , new_password: newPassword
                , confirm_password: confirmPassword
            };

            // Send the data via an AJAX request to the server
            $.ajax({
                url: "{{ route('student.update-password-change') }}", // The URL to send the request to
                type: 'POST', // Method type: POST for password change
                data: data, // The data to send (passwords)
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    // Handle success response
                    if (response.success) {
                        alert("Password changed successfully!");
                        location.reload();
                    } else {
                        alert("Error: " + response.message);
                    }
                }
                , error: function(xhr, status, error) {
                    // Handle any errors
                    alert("An error occurred: " + error);
                }
            });
        });

    });

</script>
