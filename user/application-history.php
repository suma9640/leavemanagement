<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application History</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 20px;
    }
    .container {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card {
      margin-bottom: 20px;
    }
    .card-header {
      background-color: #007bff;
      color: white;
      font-weight: bold;
    }
    .card-body {
      background-color: #ffffff;
    }
    .btn {
      background-color: #007bff;
      color: white;
      border-radius: 4px;
      padding: 8px 12px;
      font-size: 14px;
    }
    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2 class="text-center mb-4">Application History</h2>
    <div id="applications-row" class="row">
      <!-- Dynamic application cards will be inserted here -->
    </div>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      const userId = 1; // Example user_id (replace with dynamic value if needed)

      // Fetch leave applications for the specific user
      fetchLeaveApplications(userId);

      function fetchLeaveApplications(userId) {
        $.ajax({
          url: '../api/userleavehistory.php', // Your PHP file to fetch data
          method: 'GET',
          data: { user_id: userId },
          success: function(response) {
            const leaveData = JSON.parse(response);
            $('#applications-row').empty(); // Clear previous data

            // Loop through the fetched data and create dynamic leave application cards
            leaveData.forEach(function(leave) {
              let leaveCard = `
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      Application #${leave.id}
                    </div>
                    <div class="card-body">
                      <p><strong>Name:</strong> ${leave.name}</p>
                      <p><strong>Designation:</strong> ${leave.designation}</p>
                      <p><strong>Bio ID:</strong> ${leave.bio_id}</p>
                      <p><strong>Date of Leave:</strong> ${leave.leave_from} to ${leave.leave_to}</p>
                      <p><strong>No. of Days:</strong> ${leave.no_of_days}</p>
                      <p><strong>Date of Application:</strong> ${leave.application_date}</p>
                      <p><strong>Reason for Leave:</strong> ${leave.reason}</p>
                      <p><strong>Status:</strong> ${leave.status}</p>
                    </div>
                  </div>
                </div>
              `;
              $('#applications-row').append(leaveCard);
            });
          },
          error: function() {
            alert("Error fetching leave applications.");
          }
        });
      }
    });
  </script>
</body>
</html>
