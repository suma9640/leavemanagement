<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card mt-5">
          <div class="card-header text-center">
            <h4>Login</h4>
          </div>
          <div class="card-body">
            <form id="loginForm">
              <!-- Email Field -->
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" required>
                <label for="email">Email</label>
              </div>

              <!-- Password Field -->
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" required>
                <label for="password">Password</label>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#loginForm').on('submit', function(event) {
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
          url: 'api/login.php',  // PHP file to handle login logic
          method: 'POST',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.status == 'success') {
              // Redirect to dashboard or another page
              window.location.href = 'dashboard.php'; // Redirect after successful login
            } else {
              // Show error message
              alert(response.message);
            }
          },
          error: function() {
            alert('An error occurred. Please try again.');
          }
        });
      });
    });
  </script>
</body>
</html>
