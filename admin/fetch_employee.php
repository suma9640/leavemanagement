<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 20px;
            float: left;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #f4f4f4;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        /* side bar style */
        .sidebar {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
        }

        .nav {
            gap: 20px !important;
        }
        body{
            display:flex;
        }
    </style>
</head>

<body>
    
    <?php include('side.php') ?>
    <div class="container ">
        <div class="row ">
        <h1>Employee List</h1>

        <table id="employeeTable">
            <thead>
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
    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" enctype="multipart/form-data">
                        <input type="hidden" id="editEmployeeId" name="employeeId">

                        <div class="mb-3">
                            <label for="editEmployeeName" class="form-label">Employee Name:</label>
                            <input type="text" class="form-control" id="editEmployeeName" name="employeeName"><br>
                        </div>

                        <div class="mb-3">
                            <label for="editEmployeeEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="editEmployeeEmail" name="employeeEmail"><br>
                        </div>

                        <div class="mb-3">
                            <label for="editEmployeeDepartment" class="form-label">Department:</label>
                            <input type="text" class="form-control" id="editEmployeeDepartment" name="employeeDepartment"><br>
                        </div>

                        <div class="mb-3">
                            <label for="editEmployeeDesignation" class="form-label">Designation:</label>
                            <input type="text" class="form-control" id="editEmployeeDesignation" name="employeeDesignation"><br>
                        </div>

                        <div class="mb-3">
                            <label for="editEmployeeImage" class="form-label">Employee Image:</label>
                            <input type="file" class="form-control" id="editEmployeeImage" name="image"><br>
                            <img id="currentEmployeeImage" src="" alt="Current Employee Image" width="100" height="100">
                        </div>

                        <div class="mb-3">
                            <label for="editIdProof" class="form-label">ID Proof:</label>
                            <input type="file" class="form-control" id="editIdProof" name="id_proof"><br>
                            <img id="currentIdProofImage" src="" alt="Current ID Proof Image" width="100" height="100">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to fetch employee data from the backend
        $(document).ready(function() {
            $.ajax({
                url: '../api/fetch_employee.php', // Backend PHP endpoint for fetching employee data
                method: 'GET',
                dataType: 'json', // Expecting JSON response from the server
                success: function(response) {
                    if (Array.isArray(response) && response.length > 0) {
                        var tableBody = $('#employeeTable tbody');
                        tableBody.empty();

                        response.forEach(function(employee) {
                            var row = $('<tr>');
                            row.append('<td>' + employee.id + '</td>');
                            row.append('<td>' + employee.employee_name + '</td>');
                            row.append('<td>' + employee.employee_email + '</td>');
                            row.append('<td>' + employee.employee_bio_id + '</td>');
                            row.append('<td>' + employee.employee_department + '</td>');
                            row.append('<td>' + employee.employee_designation + '</td>');
                            row.append('<td><img src="' + employee.employee_image + '" alt="Employee Image" width="100" height="100"></td>');
                            row.append('<td><img src="' + employee.id_proof_image + '" alt="ID Proof Image" width="100" height="100"></td>');

                            // Add the Edit and Delete buttons
                            var actionCell = $('<td class="action-buttons">');
                            actionCell.append('<button class="btn btn-edit" onclick="editEmployee(' + employee.id + ')">Edit</button>');
                            actionCell.append('<button class="btn btn-delete" onclick="deleteEmployee(' + employee.id + ')">Delete</button>');
                            row.append(actionCell);

                            tableBody.append(row);
                        });
                    } else {
                        alert("No employee data found.");
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error fetching employee data: " + error);
                }
            });
        });

        // Function to handle Edit button click
        function editEmployee(employeeId) {
            console.log('Editing employee with ID:', employeeId); // Check the passed employee ID
            $.ajax({
                url: '../api/fetchemployeebyid.php', // Endpoint to fetch employee data by ID
                method: 'GET',
                data: {
                    id: employeeId
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Check the structure of the response

                    if (response) {
                        // Populate the modal with employee data
                        $('#editEmployeeId').val(response.id);
                        $('#editEmployeeName').val(response.employee_name);
                        $('#editEmployeeEmail').val(response.employee_email);
                        $('#editEmployeeDepartment').val(response.employee_department);
                        $('#editEmployeeDesignation').val(response.employee_designation);

                        // Update images in the modal
                        $('#currentEmployeeImage').attr('src', response.employee_image);
                        $('#currentIdProofImage').attr('src', response.id_proof_image);

                        // Show the modal
                        $('#editEmployeeModal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error fetching employee data for edit: ' + error);
                }
            });
        }


        // Handle Save Changes button click
        $('#saveChangesButton').click(function() {
            var employeeId = $('#editEmployeeId').val();
            var formData = new FormData($('#editEmployeeForm')[0]);

            // Send form data, including image and ID proof files, to the backend
            $.ajax({
                url: '../api/update_employee.php', // Endpoint to update employee
                method: 'POST',
                data: formData,
                contentType: false, // Important for file uploads
                processData: false, // Prevent jQuery from processing the data
                success: function(response) {
                    alert('Employee updated successfully!');
                    location.reload(); // Reload the page to show the updated data
                },
                error: function(xhr, status, error) {
                    alert("Error updating employee: " + error);
                }
            });
        });

        // Function to handle Delete button click
        // Function to handle Delete button click
        function deleteEmployee(employeeId) {
            var confirmation = confirm('Are you sure you want to delete this employee?');
            if (confirmation) {
                $.ajax({
                    url: '../api/delete_employee.php', // Backend PHP endpoint for deleting employee
                    method: 'POST',
                    dataType: 'json', // Expecting JSON response from the server

                    data: {
                        id: employeeId
                    },
                    success: function(response) {
                        var result = JSON.parse(response); // Parse the JSON response
                        if (result.success) {
                            alert('Employee deleted successfully!');
                            location.reload(); // Reload the page to reflect the changes
                        } else {
                            alert('Error deleting employee: ' + result.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting employee: ' + error);
                    }
                });
            }
        }
    </script>


</body>

</html>