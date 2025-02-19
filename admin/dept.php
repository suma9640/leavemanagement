<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Department</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
      display: flex;
    }
    .container {
      margin-top: 50px;
    }
    /* side bar style */
    .sidebar{
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
    }
    .nav{
      gap: 20px !important;
    }
  </style>
</head>
<body>
  
  <?php include('side.php')?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-light">
          <div class="card-header text-center bg-primary text-white">
            <h4>Add New Department</h4>
          </div>
          <div class="card-body">
            <!-- The Form -->
            <form id="departmentForm">
              <!-- Department Name -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="department-name" name="department_name" required>
                <label for="department-name">Department Name</label>
              </div>

              <!-- Department Head -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="department-head" name="department_head" required>
                <label for="department-head">Department Head</label>
              </div>

              <!-- Department Code -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="department-code" name="department_code" required>
                <label for="department-code">Department Code</label>
              </div>

              <!-- Department Description -->
              <div class="form-floating mb-3">
                <textarea class="form-control" id="department-description" name="department_description" rows="4" required></textarea>
                <label for="department-description">Department Description</label>
              </div>

              <!-- Submit Button -->
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Add Department</button>
              </div>
            </form>
            <div id="message"></div> <!-- Error/Success message will be displayed here -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (required for Bootstrap components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- AJAX Code -->
  <script>
    $(document).ready(function() {
      $('#departmentForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Make the AJAX request
        $.ajax({
          url: '../api/department.php',  // Path to your PHP backend
          method: 'POST',
          data: formData,
          dataType: 'json',  // Expecting JSON response
          success: function(response) {
            if (response.status == 'success') {
              // If the department was added successfully, show a success message
              alert(response.message); // Show the success alert message
              $('#departmentForm')[0].reset(); // Reset the form
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
