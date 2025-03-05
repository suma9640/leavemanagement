<?php
// Your database connection logic here
$conn = new mysqli('localhost', 'root', '', 'leavemanagement'); // Update with your credentials

// Fetch departments from the database
$sql = "SELECT DISTINCT department_name FROM department";  // Adjusted query to fetch distinct department names
$result = $conn->query($sql);

$departments = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
  }
} else {
  $departments = [];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leave Application Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      width: 100%;
      background-color: #f2f2f2;
    }

    .wrapper {
      width: 100%;
      max-width: 940px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(8px);
      position: relative;
      left: 11%;
      height: 640px;
      top: 60px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .form-floating {
      margin-bottom: 15px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    button {
      width: 100%;
      background: #007BFF;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .alert {
      margin-top: 20px;
    }

    /* side bar style */
    .sidebar {
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
    }

    .nav {
      gap: 20px !important;
    }
  </style>
</head>

<body>
  <?php include('side.php') ?>
  <div class="wrapper">
    <h2>Leave Application</h2>
    <form action="#" method="POST" id="leaveForm">
      <!-- Name, Designation, Bio ID (Side by side) -->
      <div class="row">
        <div class="col-md-4 form-floating mb-3">
          <input type="text" class="form-control" id="name" placeholder="Your Name" required>
          <label for="name">Name</label>
        </div>
        <div class="col-md-4 form-floating mb-3">
          <input type="text" class="form-control" id="designation" placeholder="Your Designation" required>
          <label for="designation">Designation</label>
        </div>
        <div class="col-md-4 form-floating mb-3">
          <input type="text" class="form-control" id="bioid" placeholder="Your Bio ID" required>
          <label for="bioid">Bio ID</label>
        </div>
      </div>

      <!-- Date of Leave Sought and Number of Days (Side by side) -->
      <div class="row">
        <div class="col-md-6 form-floating mb-3">
          <input type="date" class="form-control" id="leaveStart" required name="leaveStart">
          <label for="leaveStart">Leave From</label>
        </div>
        <div class="col-md-6 form-floating mb-3">
          <input type="date" class="form-control" id="leaveEnd" name="leaveEnd">
          <label for="leaveEnd">To Date (Optional)</label>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 form-floating mb-3">
          <input type="number" class="form-control" id="numDays" placeholder="Number of Days" readonly>
          <label for="numDays">No. of Days</label>
        </div>
        <!-- Leave Type Dropdown -->
        <div class="col-md-4 form-floating mb-3">
          <select class="form-select" id="leaveType" required>
            <option value="">Select Leave Type</option>
            <option value="CL">Casual Leave (CL)</option>
            <option value="SL">Sick Leave (SL)</option>
            <option value="OD">On Duty (OD)</option>
          </select>
          <label for="leaveType">Leave Type</label>
        </div>
        <!-- Date of Application -->
        <div class="col-md-4 form-floating mb-3">
          <input type="date" class="form-control" id="dateOfApplication" required name="dateOfApplication">
          <label for="dateOfApplication">Date of Application</label>
        </div>
      </div>

      <!-- Reason for Leave -->
      <div class="form-floating mb-3">
        <textarea class="form-control" id="reason" rows="4" placeholder="Reason for leave" required></textarea>
        <label for="reason">Reason for Leave</label>
      </div>

      <!-- Department Dropdown (Dynamic) -->
      <div class="form-floating mb-3">
        <select class="form-select" id="department" required>
          <option value="">Select Department</option>
          <?php
          // Ensure there is no <b> tag here
          foreach ($departments as $department): ?>
            <option value="<?= htmlspecialchars($department['department_name']); ?>">
              <?= htmlspecialchars($department['department_name']); ?>
            </option>
          <?php endforeach; ?>
        </select>
        <label for="department">Department</label>
      </div>

      <!-- Department Head (Readonly) -->
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="departmentHead" placeholder="Department Head" readonly>
        <label for="departmentHead">Department Head</label>
      </div>

      <!-- Submit Button -->
      <button type="submit">Submit Application</button>
    </form>

    <div id="responseMessage"></div> <!-- To display success or error message -->
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <!-- jQuery and AJAX Code -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      // Calculate number of days when either start or end date is changed
      $('#leaveStart, #leaveEnd').on('change', function () {
        const startDate = $('#leaveStart').val();
        let endDate = $('#leaveEnd').val();

        if (startDate) {
          // If no end date is provided, set it to the same as the start date
          if (!endDate) {
            endDate = startDate; // Treat as a single day leave
          }

          const start = new Date(startDate);
          const end = new Date(endDate);

          // Calculate the difference in days
          const timeDifference = end.getTime() - start.getTime();
          const numberOfDays = timeDifference / (1000 * 3600 * 24);

          if (numberOfDays >= 0) {
            $('#numDays').val(numberOfDays + 1); // Add 1 to include both start and end dates
          } else {
            alert('End date must be after start date.');
            $('#numDays').val('');
          }
        }
      });

      // Fetch and display department head when department is selected
      $('#department').on('change', function () {
        const selectedDepartment = $(this).val();

        if (selectedDepartment) {
          $.ajax({
            url: '../api/get_department_head.php', // API route to fetch department head
            method: 'GET',
            data: {
              department: selectedDepartment
            },
            success: function (response) {
              const res = JSON.parse(response);
              if (res.status === 'success') {
                $('#departmentHead').val(res.departmentHead); // Display department head in input field
              } else {
                alert('Failed to fetch department head.');
              }
            },
            error: function () {
              alert('Error fetching department head.');
            }
          });
        } else {
          $('#departmentHead').val(''); // Clear department head if no department is selected
        }
      });

      // Submit the leave application form
      $('#leaveForm').on('submit', function (e) {
        e.preventDefault();

        const formData = {
          name: $('#name').val(),
          bioid: $('#bioid').val(),
          designation: $('#designation').val(),
          leaveStart: $('#leaveStart').val(),
          leaveEnd: $('#leaveEnd').val() || null, // Send null if To Date is empty
          numDays: $('#numDays').val(),
          reason: $('#reason').val(),
          department: $('#department').val(),
          departmentHead: $('#departmentHead').val(), // Send department head
          leaveType: $('#leaveType').val(),
          dateOfApplication: $('#dateOfApplication').val(),
        };

        $.ajax({
          url: '../api/apply_leave.php', // Route to handle form submission
          method: 'POST',
          data: formData,
          success: function (response) {
            const res = JSON.parse(response);

            // Show the response message in an alert dialog
            alert(res.message);

            // If the response is success, reset the form
            if (res.status === 'success') {
              $('#leaveForm')[0].reset(); // Reset form after successful submission
            }
          },
          error: function (error) {
            // Show error message in an alert dialog if there is an error with the request
            alert('Error submitting the application. Please try again.');
          }
        });

      });
    });
  </script>
</body>

</html>