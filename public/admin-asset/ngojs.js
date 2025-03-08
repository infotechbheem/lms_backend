document.getElementById('ngoannouncement').addEventListener('submit', function (event) {
    event.preventDefault();

    // Announcement title validation (required)
    const announcement_title = document.getElementById('ngo_announcement_title').value.trim();
    if (announcement_title === '') {
        alert("Announcement title should not be empty!");
        return;
    }

    // Announcement description validation (required)
    const announcement_description = document.getElementById('ngo_announcement_description').value.trim();
    if (announcement_description === '') {
        alert('Announcement description should not be empty!');
        return;
    }

    // Announcement date validation (required)
    const announcement_date = document.getElementById('ngo_announcement_date').value.trim();
    if (announcement_date === '') {
        alert('Announcement date should not be empty!');
        return;
    }

    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const companyName = "{{ $companyName }}"; // Assuming this is correctly available

    // Send AJAX request
    fetch('/auth/' + companyName + '/admin/profile/announcement', {
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
            alert('An error occurred. Please try again.');
        });
});