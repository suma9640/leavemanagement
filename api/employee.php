<?php
// Include the database connection
require_once('db.php');

// Start the session
session_start();

// Create an array to store the response
$response = array();

// Check if the form is submitted via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values
    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $employee_email = mysqli_real_escape_string($conn, $_POST['employee_email']);
    $employee_bio_id = mysqli_real_escape_string($conn, $_POST['employee_bio_id']);
    $employee_department = mysqli_real_escape_string($conn, $_POST['employee_department']);
    $employee_designation = mysqli_real_escape_string($conn, $_POST['employee_designation']);

    // File upload paths
    $employee_image = $_FILES['employee_image'];
    $id_proof_image = $_FILES['id_proof_image'];

    // Validate input fields
    if (empty($employee_name) || empty($employee_email) || empty($employee_bio_id) || empty($employee_department) || empty($employee_designation) || empty($employee_image) || empty($id_proof_image)) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in all fields!';
    } else {
        // Handle file uploads
        $employee_image_path = '../uploads/' . basename($employee_image['name']);
        $id_proof_image_path = '../uploads/' . basename($id_proof_image['name']);

        // Move the uploaded files to the respective directories
        if (move_uploaded_file($employee_image['tmp_name'], $employee_image_path) && move_uploaded_file($id_proof_image['tmp_name'], $id_proof_image_path)) {
            // Insert employee data into the database with the department name
            $query = "INSERT INTO employee (employee_name, employee_email, employee_bio_id, employee_department, employee_designation, employee_image, id_proof_image) 
                      VALUES ('$employee_name', '$employee_email', '$employee_bio_id', '$employee_department', '$employee_designation', '$employee_image_path', '$id_proof_image_path')";

            if (mysqli_query($conn, $query)) {
                // Store employee data in session after successful insertion
                $_SESSION['employee_name'] = $employee_name;
                $_SESSION['employee_email'] = $employee_email;
                $_SESSION['employee_bio_id'] = $employee_bio_id;
                $_SESSION['employee_department'] = $employee_department;
                $_SESSION['employee_designation'] = $employee_designation;
                $_SESSION['employee_image'] = $employee_image_path;
                $_SESSION['id_proof_image'] = $id_proof_image_path;

                // Success response
                $response['status'] = 'success';
                $response['message'] = 'Employee added successfully!';
            } else {
                // Error response
                $response['status'] = 'error';
                $response['message'] = 'Error: Could not add employee. Please try again.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: Could not upload images. Please try again.';
        }
    }
}

// Close the database connection
mysqli_close($conn);

// Return the response as JSON
echo json_encode($response);
?>
