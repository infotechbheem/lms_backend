$(function () {
    'use strict'

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index';
    var intersect = true;

    var $donationChart = $('#donation-chart');
    var donationChart = new Chart($donationChart, {
        type: 'bar',
        data: {
            labels: [], // Labels for volunteers
            datasets: [
                {
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: [] // Donation amounts
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        callback: function (value) {
                            if (value >= 1000) {
                                value /= 1000;
                                value += 'k';
                            }
                            return '₹' + value;
                        }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    });

    // Function to update the chart and UI elements with new data
    function updateDonationChart(newData) {
        // Update the labels with volunteer names
        donationChart.data.labels = newData.volunteerNames;

        // Update the dataset values
        donationChart.data.datasets[0].data = newData.donations;

        // Update the total donation and team leader name
        $('#totalDonation').text("₹" + newData.totalDonation || '0.00');
        $('#teamLeaderName').text('Total Donation collected By : ' + newData.teamLeaderName || 'Total Donation collected');

        // Re-render the chart with the new data
        donationChart.update();
    }

    $('#donationActivityForm').on('submit', async function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get the selected team leader ID
        // Get form data
        var teamLeaderId = document.getElementById('team_leader').value;
        var fromDate = document.getElementById('from_date').value; // Assuming you have an input field with ID 'from_date'
        var toDate = document.getElementById('to_date').value; // Assuming you have an input field with ID 'to_date'
        if (teamLeaderId) {
            try {
                let response = await fetch('/auth/admin/volunteer/team-leader/get-donation-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        team_leader_id: teamLeaderId,
                        from_date: fromDate,
                        to_date: toDate
                    })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }


                let data = await response.json();

                // Update the chart with new data
                updateDonationChart({
                    volunteerNames: data.volunteerNames,
                    donations: data.donations,
                    totalDonation: data.totalDonation,
                    teamLeaderName: data.teamLeaderName
                });

            } catch (error) {
                console.error('Fetch Error:', error);
                alert('An error occurred while fetching the donation data.');
            }
        } else {
            // Reset the chart if no team leader is selected
            updateDonationChart({
                volunteerNames: [],
                donations: [],
                totalDonation: '0.00',
                teamLeaderName: 'Total Donation collected'
            });
        }
    });
});
