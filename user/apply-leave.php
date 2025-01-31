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
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      width: 100%;
      background-color: #f2f2f2;
    }
    .wrapper {
      width: 100%;
      max-width: 600px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(8px);
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
      padding: 12px;
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
  </style>
</head>
<body>
  <div class="wrapper">
    <h2>Leave Application</h2>
    <form action="#">
      <!-- Name, Designation, Bio ID -->
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" placeholder="Your Name" required>
        <label for="name">Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="designation" placeholder="Your Designation" required>
        <label for="designation">Designation</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="bioid" placeholder="Your Bio ID" required>
        <label for="bioid">Bio ID</label>
      </div>

      <!-- Date of Leave Sought and Number of Days in the same row -->
      <div class="row">
        <div class="col-md-6 form-floating mb-3">
          <input type="date" class="form-control" id="leaveStart" required>
          <label for="leaveStart">Date of Leave Sought</label>
        </div>
        <div class="col-md-6 form-floating mb-3">
          <input type="number" class="form-control" id="numDays" placeholder="Number of Days" required>
          <label for="numDays">No. of Days</label>
        </div>
      </div>

      <!-- Date of Application -->
      <div class="form-floating mb-3">
        <input type="date" class="form-control" id="dateOfApplication" required>
        <label for="dateOfApplication">Date of Application</label>
      </div>

      <!-- Reason for Leave -->
      <div class="form-floating mb-3">
        <textarea class="form-control" id="reason" rows="4" placeholder="Reason for leave" required></textarea>
        <label for="reason">Reason for Leave</label>
      </div>

      <!-- Submit Button -->
      <button type="submit">Submit Application</button>
    </form>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
