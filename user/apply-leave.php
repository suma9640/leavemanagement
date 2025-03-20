<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
    <title>Leave Application Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* display: flex; */
            min-height: 100vh;
            background-color: #f2f2f2;
            justify-content: center;
            align-items: center;
            /* padding: 20px; */
        }
        .wrapper {
            width: 100%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
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
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .row > div {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
      <?php include('side.php') ?>

    <div class="wrapper py-5">
        <h2>Leave Application</h2>
        <form action="#" method="POST" id="leaveForm">
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
            <div class="row">
                <div class="col-md-6 form-floating mb-3">
                    <input type="date" class="form-control" id="leaveStart" required>
                    <label for="leaveStart">Leave From</label>
                </div>
                <div class="col-md-6 form-floating mb-3">
                    <input type="date" class="form-control" id="leaveEnd">
                    <label for="leaveEnd">To Date (Optional)</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-floating mb-3">
                    <input type="number" class="form-control" id="numDays" placeholder="Number of Days" readonly>
                    <label for="numDays">No. of Days</label>
                </div>
                <div class="col-md-4 form-floating mb-3">
                    <select class="form-select" id="leaveType" required>
                        <option value="">Select Leave Type</option>
                        <option value="CL">Casual Leave (CL)</option>
                        <option value="SL">Sick Leave (SL)</option>
                        <option value="OD">On Duty (OD)</option>
                    </select>
                    <label for="leaveType">Leave Type</label>
                </div>
                <div class="col-md-4 form-floating mb-3">
                    <input type="date" class="form-control" id="dateOfApplication" required>
                    <label for="dateOfApplication">Date of Application</label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" id="reason" rows="4" placeholder="Reason for leave" required></textarea>
                <label for="reason">Reason for Leave</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="department" required>
                    <option value="">Select Department</option>
                    <!-- PHP Code to Fetch Departments Dynamically -->
                </select>
                <label for="department">Department</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="departmentHead" placeholder="Department Head" readonly>
                <label for="departmentHead">Department Head</label>
            </div>
            <button type="submit">Submit Application</button>
        </form>
        <div id="responseMessage"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#leaveStart, #leaveEnd').on('change', function () {
                const startDate = $('#leaveStart').val();
                let endDate = $('#leaveEnd').val();
                if (startDate) {
                    if (!endDate) { endDate = startDate; }
                    const start = new Date(startDate);
                    const end = new Date(endDate);
                    const timeDifference = end.getTime() - start.getTime();
                    const numberOfDays = timeDifference / (1000 * 3600 * 24);
                    $('#numDays').val(numberOfDays >= 0 ? numberOfDays + 1 : '');
                }
            });
        });
    </script>
</body>
</html>