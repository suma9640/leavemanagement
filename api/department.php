<?php
// Include the database connection file
require_once('db.php');

// Create an array to store the response
$response = array();

// Check if the form is submitted via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values from the form
    $department_name = mysqli_real_escape_string($conn, $_POST['department_name']);
    $department_head = mysqli_real_escape_string($conn, $_POST['department_head']);
    $department_code = mysqli_real_escape_string($conn, $_POST['department_code']);
    $department_description = mysqli_real_escape_string($conn, $_POST['department_description']);

    // Validate the inputs
    if (empty($department_name) || empty($department_head) || empty($department_code) || empty($department_description)) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in all fields!';
    } else {
        // Insert the department details into the database
        $query = "INSERT INTO department (department_name, department_head, department_code, department_description)
                  VALUES ('$department_name', '$department_head', '$department_code', '$department_description')";

        if (mysqli_query($conn, $query)) {
            // Success response
            $response['status'] = 'success';
            $response['message'] = 'Department added successfully!';
        } else {
            // Error response
            $response['status'] = 'error';
            $response['message'] = 'Error: Could not add department. Please try again.';
        }
    }
}

// Close the database connection
mysqli_close($conn);

// Return the response as JSON
echo json_encode($response);
?>
