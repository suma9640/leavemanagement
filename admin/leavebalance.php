<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Leave Management</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            /* min-height: 100vh;
            align-items: center;
            justify-content: center; */
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* width: 100%; */
            width: 50%;
    /* max-width: 400px; */
    position: relative;
    left: 16%;
    top:20px;
    height: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            font-size: 16px;
            color: #333;
        }

        input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        #message {
            margin-top: 20px;
            text-align: center;
        }

        .alert {
            font-size: 16px;
            font-weight: bold;
        }

        .sidebar {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
        }

        .nav {
            gap: 20px !important;
        }
    </style>
</head>

<body>
    <!-- Sidebar Inclusion -->
    <?php include('side.php') ?>

    <!-- Form Container -->
    <div class="form-container">
        <form id="adjustLeaveForm">
            <h2>Adjust Leave Balances</h2>

            <label for="employeeId">Employee ID:</label>
            <input type="number" id="employeeId" name="employee_id" required>

            <label for="clBalance">Casual Leave (Adjust):</label>
            <input type="number" id="clBalance" name="cl_balance" step="0.5" value="0">

            <label for="slBalance">Sick Leave (Adjust):</label>
            <input type="number" id="slBalance" name="sl_balance" step="0.5" value="0">

            <button type="submit">Update Balances</button>
        </form>

        <!-- Message Area -->
        <div id="message"></div>
    </div>

    <script>
        $(document).ready(function () {
            $("#adjustLeaveForm").submit(function (event) {
                event.preventDefault();

                $.ajax({
                    url: '../api/leavebalance.php',  // Your PHP script for updating leave balance
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        $("#message").empty(); // Clear any previous message

                        // Display success or error message
                        if (response.status === 'success') {
                            $("#message").html(`<div class="alert alert-success">${response.message}</div>`);
                            $("#adjustLeaveForm")[0].reset(); // Clear the form after success
                        } else {
                            $("#message").html(`<div class="alert alert-danger">${response.message}</div>`);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        $("#message").html(`<div class="alert alert-danger">An error occurred. Please try again later.</div>`);
                    }
                });
            });
        });
    </script>

</body>

</html>
