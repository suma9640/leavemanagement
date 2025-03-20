<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
    <title>Employee List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <h1>Employee List</h1>

    <table id="employeeTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Hire Date</th>
            </tr>
        </thead>
        <tbody>
            <!-- Employee rows will be inserted here -->
        </tbody>
    </table>

    <h2>Employee Department</h2>
    <select id="employee-department">
        <option value="" disabled selected>Select Department</option>
    </select>

    <script>
        // Fetch departments dynamically
        $(document).ready(function () {
            $.ajax({
                url: '../api/fetchdepartment.php', // PHP script to fetch department data
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var departmentSelect = $('#employee-department');
                    departmentSelect.empty(); // Clear the existing options

                    // Check if the response is successful
                    if (response.status === 'success') {
                        // Add a default "Select Department" option
                        departmentSelect.append('<option value="" disabled selected>Select Department</option>');

                        // Loop through the fetched departments and append them to the dropdown
                        response.data.forEach(function(department) {
                            departmentSelect.append('<option value="' + department.department_name + '">' + department.department_name + '</option>');
                        });
                    } else {
                        // If there's an error, show the error message
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error fetching departments.');
                }
            });
        });

        // Function to fetch employee data from the backend and populate the table
        function fetchEmployees() {
            $.ajax({
                url: '../api/fetch_employee.php', // PHP script to fetch employee data
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const tableBody = $('#employeeTable tbody');
                    tableBody.empty(); // Clear existing rows

                    // Loop through the data and insert it into the table
                    response.forEach(function(employee) {
                        const row = $('<tr></tr>'); // Create a new row
                        row.html(`
                            <td>${employee.id}</td>
                            <td>${employee.first_name}</td>
                            <td>${employee.last_name}</td>
                            <td>${employee.email}</td>
                            <td>${employee.position}</td>
                            <td>${employee.hire_date}</td>
                        `);
                        tableBody.append(row); // Append the row to the table
                    });
                },
                error: function() {
                    alert('Error fetching employee data.');
                }
            });
        }

        // Fetch employees when the page loads
        fetchEmployees();
    </script>

</body>
</html>
