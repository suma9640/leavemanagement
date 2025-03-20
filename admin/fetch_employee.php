<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-wrap: wrap;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #f8f9fa;
            height: 100vh;
            padding: 20px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .sidebar .nav-link {
            color: #333;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <?php include('side.php') ?>
    <div class="container-fluid">
        <h1 class="mt-4">Employee List</h1>
        <div class="table-container">
            <table class="table table-bordered table-striped" id="employeeTable">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>BIO ID</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Image</th>
                        <th>ID Proof</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Employee rows will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '../api/fetch_employee.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    var tableBody = $('#employeeTable tbody');
                    tableBody.empty();

                    response.forEach(function (employee) {
                        var row = `<tr>
                            <td>${employee.id}</td>
                            <td>${employee.name}</td>
                            <td>${employee.email}</td>
                            <td>${employee.bioid}</td>
                            <td>${employee.departmet}</td>
                            <td>${employee.designation}</td>
                            // <td><img src="${employee.profile_image}" alt="Employee Image" width="100" height="100"></td>
                            <td><img src="${employee.profile_image}" alt="ID Proof Image" width="100" height="100"></td>
                            <td>
                                <button class="btn btn-success" onclick="editEmployee(${employee.id})">Edit</button>
                                <button class="btn btn-danger" onclick="deleteEmployee(${employee.id})">Delete</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                    });
                },
                error: function (xhr, status, error) {
                    alert("Error fetching employee data: " + error);
                }
            });
        });
    </script>
</body>

</html>