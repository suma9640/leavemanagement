<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-light">
          <div class="card-header text-center bg-primary text-white">
            <h4>Add New Employee</h4>
          </div>
          <div class="card-body">
            <form id="employeeForm" enctype="multipart/form-data">
              <!-- Employee Name -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="employee-name" name="employee_name" required>
                <label for="employee-name">Employee Name</label>
              </div>

              <!-- Employee Email -->
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="employee-email" name="employee_email" required>
                <label for="employee-email">Employee Email</label>
              </div>

              <!-- Employee Bio ID -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="employee-bio_id" name="employee_bio_id" required>
                <label for="employee-bio_id">Employee Bio ID</label>
              </div>

              <!-- Department -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="employee-department" name="employee_department" required>
                <label for="employee-department">Employee Department</label>
              </div>

              <!-- Employee Designation -->
              <div class="form-floating mb-3">
                <textarea class="form-control" id="employee-designation" name="employee_designation" rows="4" required></textarea>
                <label for="employee-designation">Employee Designation</label>
              </div>

              <!-- Employee Image -->
              <div class="form-floating mb-3">
                <input type="file" class="form-control" id="employee-image" name="employee_image" accept="image/*" required>
                <label for="employee-image">Employee Image</label>
              </div>

              <!-- ID Proof Image -->
              <div class="form-floating mb-3">
                <input type="file" class="form-control" id="id-proof-image" name="id_proof_image" accept="image/*" required>
                <label for="id-proof-image">ID Proof Image</label>
              </div>

              <!-- Submit Button -->
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Add Employee</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (required for Bootstrap components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery and AJAX Code -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#employeeForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Make the AJAX request
        $.ajax({
          url: '../api/employee.php',  // Path to your PHP backend
          method: 'POST',
          data: new FormData(this), // Use FormData to send the form data and files
          contentType: false, // Let jQuery set the content type
          processData: false, // Don't process the data (files will be uploaded)
          dataType: 'json',  // Expecting JSON response
          success: function(response) {
            if (response.status == 'success') {
              // If the employee was added successfully, show a success message
              alert(response.message); // Show the success alert message
              $('#employeeForm')[0].reset(); // Reset the form
            } else {
              // If there was an error, show an error message
              alert(response.message); // Show the error alert message
            }
          },
          error: function() {
            // If the AJAX request fails, show an error message
            alert('An error occurred. Please try again.');
          }
        });
      });
    });
  </script>
</body>
</html>
