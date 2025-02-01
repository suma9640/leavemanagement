<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .leave-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .approve-btn {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        .reject-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-container {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Leave Applications</h2>
        <div id="leave-applications">
            <!-- Leave applications will be dynamically inserted here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch leave applications when the page loads
            fetchLeaveApplications();

            // Function to fetch leave applications from the server
            function fetchLeaveApplications() {
                $.ajax({
                    url: '../api/fetch-leaves.php', // Your backend PHP file to fetch leave data
                    method: 'GET',
                    success: function(response) {
                        let leaveData = JSON.parse(response);
                        $('#leave-applications').empty(); // Clear previous data

                        // Loop through the fetched data and display each leave application
                        leaveData.forEach(function(leave) {
                            let leaveCard = `
                            <div class="leave-card">
                                <h5>${leave.name} (${leave.designation})</h5>
                                <p><strong>Leave Dates:</strong> ${leave.dateleavesought_from} to ${leave.dateleavesought_to}</p>
                                <p><strong>Reason:</strong> ${leave.reason}</p>
                                <p><strong>Status:</strong> ${leave.status}</p>
                                <div class="btn-container">
                                    <button class="approve-btn" data-id="${leave.id}">Approve</button>
                                    <button class="reject-btn" data-id="${leave.id}">Reject</button>
                                </div>
                            </div>
                        `;
                            $('#leave-applications').append(leaveCard);
                        });
                    }
                });
            }

            // Handle approve button click
            $(document).on('click', '.approve-btn', function() {
                let leaveId = $(this).data('id');
                changeLeaveStatus(leaveId, 'approved');
            });

            // Handle reject button click
            $(document).on('click', '.reject-btn', function() {
                let leaveId = $(this).data('id');
                changeLeaveStatus(leaveId, 'rejected');
            });

            // Function to update the leave status (approve/reject)
            function changeLeaveStatus(leaveId, status) {
    $.ajax({
        url: '../api/update_leave_status.php', // Your PHP file to update the status in the database
        method: 'POST',
        data: {
            id: leaveId,
            status: status
        },
        success: function(response) {
            try {
                // Attempt to parse the response if it is not already JSON
                let res = JSON.parse(response);
                
                // If response message exists, alert it
                if (res.message) {
                    alert(res.message);
                } else {
                    alert("Unexpected response format.");
                }

                // Re-fetch leave applications to reflect the status change
                fetchLeaveApplications();
            } catch (error) {
                // Catch any error in parsing JSON or in the response
                alert("Error processing response: " + error);
            }
        },
        error: function(xhr, status, error) {
            // Improved error handling with error details
            alert("Error communicating with the server. Status: " + status + ", Error: " + error);
        }
    });
}


        });
    </script>

</body>

</html>