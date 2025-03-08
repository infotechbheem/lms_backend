$(document).ready(function () {
    $('#expanseSubmitForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get form data
        var formData = $(this).serialize();

        try {
            // AJAX request
            $.ajax({
                url: '/auth/admin/expanse/get-expanse-data', // Set the correct URL with companyName
                type: 'POST',
                data: formData,

                success: function (response) {
                    try {
                        if (response.data && response.data.length > 0) {

                            $('#expanseTotalAmount').text(response.totalExpanse);
                            // Clear the table body
                            $('#expanseTableBody').empty();
                            // Loop through the response data and append rows to the table
                            $.each(response.data, function (index, expanse) {
                                // Format the amount with two decimal places
                                let formattedAmount = parseFloat(expanse.amount).toFixed(2);
                                // Format the created_at date to display only the date
                                let formattedDate = new Date(expanse.created_at).toLocaleDateString();

                                $('#expanseTableBody').append(`
                                    <tr scope="row">
                                        <td>${index + 1}</td>
                                        <td class="text-center">${expanse.expanse_id}</td>
                                        <td class="text-center">${expanse.title}</td>
                                        <td class="text-center">${expanse.purpose}</td>
                                        <td class="text-center">${formattedAmount}</td>
                                        <td class="text-center">${formattedDate}</td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#expanseTableBody').html('<tr><td colspan="6" class="text-center">No donations found</td></tr>');
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

            alert('An unexpected error occurred. Please check the console for details.', outerError);
        }
    });

    $('#ngoExpanseSubmitForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get form data
        var formData = $(this).serialize();
        var companyName = "{{ $companyName }}";  // Access the shared 'companyName' variable
        try {
            // AJAX request
            $.ajax({
                url: '/auth/' + companyName + '/admin/expanse/get-expanse-data', // Set the correct URL with companyName
                type: 'POST',
                data: formData,

                success: function (response) {
                    try {
                        if (response.data && response.data.length > 0) {

                            $('#ngoExpanseTotalAmount').text(response.totalExpanse);
                            // Clear the table body
                            $('#ngoExpanseTableBody').empty();
                            // Loop through the response data and append rows to the table
                            $.each(response.data, function (index, expanse) {
                                // Format the amount with two decimal places
                                let formattedAmount = parseFloat(expanse.amount).toFixed(2);
                                // Format the created_at date to display only the date
                                let formattedDate = new Date(expanse.created_at).toLocaleDateString();

                                $('#ngoExpanseTableBody').append(`
                                    <tr scope="row">
                                        <td>${index + 1}</td>
                                        <td class="text-center">${expanse.expanse_id}</td>
                                        <td class="text-center">${expanse.title}</td>
                                        <td class="text-center">${expanse.purpose}</td>
                                        <td class="text-center">${formattedAmount}</td>
                                        <td class="text-center">${formattedDate}</td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#ngoExpanseTableBody').html('<tr><td colspan="6" class="text-center">No donations found</td></tr>');
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

            alert('An unexpected error occurred. Please check the console for details.', outerError);
        }
    });


    $('#printexpanseBtn').on('click', function () {
        printTable();
    });

    function printTable() {
        var tableContent = $('#expanseTable')[0].outerHTML; // Get the HTML content of the table
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Table</title>');
        printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid black; padding: 10px; text-align: center; }</style>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(tableContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // Close the document
        printWindow.print(); // Print the contents
    }


    document.getElementById('downloadExpansePDF').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;

        // Create a new jsPDF instance
        const doc = new jsPDF();

        // Generate the PDF from the table
        doc.autoTable({
            html: '#expanseTable',
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
                doc.text('Expanse Report', data.settings.margin.left, 10);

                // Bottom margin text (if needed)
                var pageHeight = doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
                doc.text('Page ' + doc.internal.getNumberOfPages(), data.settings.margin.left, pageHeight - 10);
            }
        });

        // Save the generated PDF
        doc.save('expanse-report.pdf');
    });

});
