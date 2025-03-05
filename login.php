<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('images/login-bg.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }

    .login-container {
      width: 100%;
      height: 100vh;
      display: flex;
      flex-direction: column;
      /* align-items: center; */
      justify-content: center;
    }
  </style>
</head>

<body>
  <div class="container login-container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card mt-5">
          <div class="card-header text-center">
            <h4>Login</h4>
          </div>
          <div class="card-body">
            <form id="loginForm">
              <!-- Bio ID Field -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="bioid" name="bioid" placeholder="Enter your Bio ID"
                  required>
                <label for="bioid">Bio ID</label>
              </div>



              <!-- Password Field -->
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password"
                  placeholder="Enter your password" required>
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
    $(document).ready(function () {
      $('#loginForm').on('submit', function (event) {
        event.preventDefault();

        var formData = $(this).serialize(); // This will serialize all form fields including bioid

        $.ajax({
          url: 'api/login.php',
          method: 'POST',
          data: formData,
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
              // Show a success alert
              alert(response.message);

              // Redirect user based on their role
              if (response.usertype === 'admin') {
                window.location.href = 'admin/adminhome.php';
              } else if (response.usertype === 'user') {
                window.location.href = 'user/userhome.php';
              } else {
                window.location.href = 'guest_dashboard.php';
              }
            } else {
              // Show an error alert
              alert('Error: ' + response.message);
            }
          },
          error: function () {
            alert('An error occurred. Please try again.');
          }
        });
      });
    });
  </script>
</body>

</html>