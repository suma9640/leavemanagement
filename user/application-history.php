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

    <!-- Card Layout for Application History -->
    <div class="row">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Application #1
          </div>
          <div class="card-body">
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Designation:</strong> Software Developer</p>
            <p><strong>Bio ID:</strong> JD123</p>
            <p><strong>Date of Leave:</strong> 2025-02-01</p>
            <p><strong>No. of Days:</strong> 3</p>
            <p><strong>Date of Application:</strong> 2025-01-30</p>
            <p><strong>Reason for Leave:</strong> Sick Leave</p>
            <p><strong>Status:</strong> Approved</p>
            <!-- Optional Action Button -->
            <!-- <button class="btn">View</button> -->
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Application #2
          </div>
          <div class="card-body">
            <p><strong>Name:</strong> Jane Smith</p>
            <p><strong>Designation:</strong> Project Manager</p>
            <p><strong>Bio ID:</strong> JS456</p>
            <p><strong>Date of Leave:</strong> 2025-02-05</p>
            <p><strong>No. of Days:</strong> 5</p>
            <p><strong>Date of Application:</strong> 2025-01-29</p>
            <p><strong>Reason for Leave:</strong> Personal Leave</p>
            <p><strong>Status:</strong> Pending</p>
            <!-- Optional Action Button -->
            <!-- <button class="btn">View</button> -->
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Application #3
          </div>
          <div class="card-body">
            <p><strong>Name:</strong> Michael Brown</p>
            <p><strong>Designation:</strong> Team Leader</p>
            <p><strong>Bio ID:</strong> MB789</p>
            <p><strong>Date of Leave:</strong> 2025-02-07</p>
            <p><strong>No. of Days:</strong> 2</p>
            <p><strong>Date of Application:</strong> 2025-01-28</p>
            <p><strong>Reason for Leave:</strong> Vacation</p>
            <p><strong>Status:</strong> Rejected</p>
            <!-- Optional Action Button -->
            <!-- <button class="btn">View</button> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
