<!DOCTYPE html>
<html>
<head>
    <title>Admin Leave Management</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic Styling */
        form {
            width: 300px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

    </style>
</head>
<body>

    <h2>Adjust Leave Balances</h2>

    <form id="adjustLeaveForm">
        <label for="employeeId">Employee ID:</label>
        <input type="number" id="employeeId" name="employee_id" required><br>

        <label for="clBalance">Casual Leave (Adjust):</label>
        <input type="number" id="clBalance" name="cl_balance" step="0.5" value="0"><br>  <label for="slBalance">Sick Leave (Adjust):</label>
        <input type="number" id="slBalance" name="sl_balance" step="0.5" value="0"><br>  <button type="submit">Update Balances</button>
    </form>

    <div id="message"></div>  <script>
        $(document).ready(function() {
            $("#adjustLeaveForm").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '../api/leavebalance.php',  // Your PHP script
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $("#message").text(response.message); // Display message from server
                        if (response.status === 'success') {
                            $("#adjustLeaveForm")[0].reset(); // Clear form on success
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        $("#message").text("An error occurred. Please try again later.");
                    }
                });
            });
        });
    </script>

</body>
</html>