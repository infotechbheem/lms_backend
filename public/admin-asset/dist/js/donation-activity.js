$(document).ready(function () {
    $('#donationActivityForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get form data
        var formData = $(this).serialize();

        try {
            // AJAX request
            $.ajax({
                url: '/auth/admin/donation/donation-activity', // Set the correct URL with companyName
                type: 'POST',
                data: formData,

                success: function (response) {
                    try {
                        if (response.data && response.data.length > 0) {
                            // Clear the table body
                            $('#donationActivityTableBody').empty();
                            // Loop through the response data and append rows to the table
                            $.each(response.data, function (index, donation) {
                                // Format the amount with two decimal places
                                let formattedAmount = parseFloat(donation.amount).toFixed(2);
                                let statusText = donation.payment_status ? 'Success' : 'Failed';
                                let statusClass = donation.payment_status ? 'badge badge-pill badge-success' : 'badge badge-pill badge-danger';
                                // Format the created_at date to display only the date
                                let formattedDate = new Date(donation.created_at).toLocaleDateString();

                                $('#donationActivityTableBody').append(`
                                    <tr scope="row">
                                        <td>${index + 1}</td>
                                        <td class="text-center">${donation.donation_id}</td>
                                        <td class="text-center">${donation.name}</td>
                                        <td class="text-center">${formattedAmount}</td>
                                        <td class="text-center">${donation.phone_number}</td>
                                        <td class="text-center">${donation.purpose ?? "N/A"}</td>
                                        <td class="text-center">${donation.volunteer ?? "N/A"}</td>
                                        <td class="text-center">${donation.aadhar_number ?? "N/A"}  </td>
                                        <td class="text-center">${formattedDate}</td>
                                        <td class="text-center"><span class="${statusClass}">${statusText}</span></td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#donationActivityTableBody').html('<tr><td colspan="10" class="text-center">No donations found</td></tr>');
                        }
                    } catch (innerError) {
                        alert('An error occurred while processing the response data.');
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        } catch (outerError) {
            alert('An unexpected error occurred. Please check the console for details.');
            console.error(outerError);
        }
    });


    const $teamLeaderSelect = $('#team_leader');
    const $volunteerSelect = $('#volunteer');

    if ($teamLeaderSelect.length === 0 || $volunteerSelect.length === 0) {
        // console.error('Required elements not found in the DOM.');
        return;
    }

    $teamLeaderSelect.on('change', async function () {
        const teamLeaderId = $(this).val();

        if (!teamLeaderId) {
            $volunteerSelect.html('<option value="">Select Volunteer</option>');
            return;
        }



        try {
            const response = await fetch('/auth/admin/volunteer/team-leader/get-volunteers', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Fetch the token dynamically
                },
                body: JSON.stringify({ team_leader_id: teamLeaderId })
            });

            if (response.status === 419) {
                alert('Session expired. Please reload the page.');
                return;
            }

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            $volunteerSelect.empty(); // Clear current options

            if (data.volunteers.length > 0) {
                $volunteerSelect.append('<option value="">Select Volunteer</option>');
                data.volunteers.forEach(volunteer => {
                    $volunteerSelect.append(`<option value="${volunteer.volunteer_id}">${volunteer.name}</option>`);
                });
            } else {
                $volunteerSelect.append('<option value="">No Volunteers Available</option>');
            }
        } catch (error) {

            alert('An error occurred while fetching the volunteers.');
        }
    });


    $('#printTableBtn').on('click', function () {
        printTable();
    });

    function printTable() {
        var tableContent = $('#donationTable')[0].outerHTML; // Get the HTML content of the table
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Table</title>');
        printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid black; padding: 10px; text-align: center; }</style>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(tableContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // Close the document
        printWindow.print(); // Print the contents
    }

    document.getElementById('downloadPDF').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;

        // Create a new jsPDF instance
        const doc = new jsPDF();

        // Generate the PDF from the table
        doc.autoTable({
            html: '#donationTable',
            styles: {
                halign: 'center' // Center align the text in the table
            },
            headStyles: {
                fillColor: [0, 0, 0] // Optional: Change header background color
            },
            footStyles: {
                fillColor: [0, 0, 0] // Optional: Change footer background color
            },
            alternateRowStyles: {
                fillColor: [240, 240, 240] // Optional: Alternating row color
            },
            margin: { top: 20, bottom: 20 }, // Top and bottom margin
            didDrawPage: function (data) {
                // Top margin text
                doc.text('Donation Activity Report', data.settings.margin.left, 10);

                // Bottom margin text (if needed)
                var pageHeight = doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
                doc.text('Page ' + doc.internal.getNumberOfPages(), data.settings.margin.left, pageHeight - 10);
            }
        });

        // Save the generated PDF
        doc.save('donation-activity-report.pdf');
    });

});
