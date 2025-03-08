document.getElementById('toggleId').addEventListener('click', function () {
    const passwordField = document.getElementById('mainKey');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle the eye icon
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

document.getElementById('toggleSecret').addEventListener('click', function () {
    const passwordField = document.getElementById('secretKey');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle the eye icon
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle the eye icon
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});



document.getElementById('adminChangePassword').addEventListener('submit', function (event) {
    event.preventDefault();

    // Old password validation (required)
    const oldPassword = document.getElementById('old_password').value.trim();
    if (oldPassword === '') {
        alert("Old password should not be empty!");
        return;
    }

    // New password validation (required)
    const newPassword = document.getElementById('new_password').value.trim();
    if (newPassword === '') {
        alert('New password should not be empty!');
        return;
    }

    // Confirm password validation (required and must match new password)
    const cnfPassword = document.getElementById('cnf_password').value.trim();
    if (cnfPassword === '') {
        alert('Confirm password should not be empty!');
        return;
    } else if (cnfPassword !== newPassword) {
        alert("Confirm password and new password do not match!");
        return;
    }

    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send AJAX request
    fetch('/auth/admin/profile/change-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            old_password: oldPassword,
            new_password: newPassword,
            cnf_password: cnfPassword
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Password changed successfully');
                location.reload(); // Reload the page or redirect as needed
            } else {
                alert('Error: ' + JSON.stringify(data.errors));
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});


document.getElementById('announcement').addEventListener('submit', function (event) {
    event.preventDefault();
    // Old password validation (required)
    const announcement_title = document.getElementById('announcement_title').value.trim();
    if (announcement_title === '') {
        alert("Announcement title should not be empty!");
        return;
    }

    // New password validation (required)
    const announcement_description = document.getElementById('announcement_description').value.trim();
    if (announcement_description === '') {
        alert('Announcement description should not be empty!');
        return;
    }

    // Confirm password validation (required and must match new password)
    const announcement_date = document.getElementById('announcement_date').value.trim();
    if (announcement_date === '') {
        alert('Announcement date should not be empty!');
        return;
    }

    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send AJAX request
    fetch('/auth/admin/profile/announcement', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            announcement_title: announcement_title,
            announcement_description: announcement_description,
            announcement_date: announcement_date
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Announcement Added Successfully!!');
                location.reload(); // Reload the page or redirect as needed
            } else {
                alert('Error: ' + JSON.stringify(data.errors));
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

