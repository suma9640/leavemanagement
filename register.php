<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glassmorphism Signup Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Open Sans", sans-serif;
    }
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      width: 100%;
      padding: 0 10px;
    }
    body::before {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      background: url("images/leaves.jpg"), #000;
      background-position: center;
      background-size: cover;
    }
    .wrapper {
      width: 400px;
      border-radius: 8px;
      padding: 30px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
    }
    form {
      display: flex;
      flex-direction: column;
    }
    h2 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #fff;
    }
    .input-field {
      position: relative;
      border-bottom: 2px solid #ccc;
      margin: 15px 0;
    }
    .input-field label {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      color: #fff;
      font-size: 16px;
      pointer-events: none;
      transition: 0.15s ease;
    }
    .input-field input {
      width: 100%;
      height: 40px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 16px;
      color: #fff;
    }
    .input-field input:focus~label,
    .input-field input:valid~label {
      font-size: 0.8rem;
      top: 10px;
      transform: translateY(-120%);
    }
    .forget {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 25px 0 35px 0;
      color: #fff;
    }
    #remember {
      accent-color: #fff;
    }
    .forget label {
      display: flex;
      align-items: center;
    }
    .forget label p {
      margin-left: 8px;
    }
    .wrapper a {
      color: #efefef;
      text-decoration: none;
    }
    .wrapper a:hover {
      text-decoration: underline;
    }
    button {
      background: #fff;
      color: #000;
      font-weight: 600;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 3px;
      font-size: 16px;
      border: 2px solid transparent;
      transition: 0.3s ease;
    }
    button:hover {
      color: #fff;
      border-color: #fff;
      background: rgba(255, 255, 255, 0.15);
    }
    .register {
      text-align: center;
      margin-top: 30px;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form id="signupForm">
      <h2>Sign Up</h2>
      <div class="input-field">
        <input type="text" id="name" name="name" required>
        <label for="name">Enter your name</label>
      </div>
      <div class="input-field">
        <input type="email" id="email" name="email" required>
        <label for="email">Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" id="password" name="password" required>
        <label for="password">Create your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Agree to terms and conditions</p>
        </label>
      </div>
      <button type="submit">Sign Up</button>
      <div class="register">
        <p>Already have an account? <a href="#">Login</a></p>
      </div>
    </form>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#signupForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get form data
        var formData = new FormData(this);

        // Make AJAX request to backend
        $.ajax({
          url: 'api/register.php',  // Backend PHP file
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              alert(response.message);  // Show success message
              window.location.href = 'login.php';  // Redirect to login page after successful signup
            } else {
              alert(response.message);  // Show error message
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
