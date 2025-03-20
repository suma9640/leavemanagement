<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="uploads/logo-image.png" type="image/x-icon">
  <title>Signup Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('images/login-bg.jpg');
      background-repeat: no-repeat;
      background-size: cover;      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      max-width: 500px;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center mb-4">Sign Up</h2>
    <form id="signupForm" enctype="multipart/form-data">
      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="bioid" class="form-label">Bio ID</label>
          <input type="text" id="bioid" name="bioid" class="form-control" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="name" class="form-label">Name</label>
          <input type="text" id="name" name="name" class="form-control" required>
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="designation" class="form-label">Designation</label>
          <input type="text" id="designation" name="designation" class="form-control" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="department" class="form-label">Department</label>
          <input type="text" id="department" name="department" class="form-control" required>
        </div>
      </div>
      <div class="mb-3">
        <label for="profile_image" class="form-label">Profile Image (optional)</label>
        <input type="file" id="profile_image" name="profile_image" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary w-100">Sign Up</button>
    </form>
    <div class="text-center mt-3">
      <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#signupForm').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
          url: 'api/register.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              alert(response.message);
              window.location.href = 'login.php';
            } else {
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