<?php
// Start the session at the beginning
session_start();

// Include database connection file
require_once('db.php');

// Create an array to store response
$response = array();

// Check if the form was submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values and sanitize them
    $bioid = mysqli_real_escape_string($conn, $_POST['bioid']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    $user_type = 'user';  // Default user type
    $default_profile_image = 'uploads/profile.png'; // Path to default image

    // Check if the fields are empty
    if (empty($bioid) || empty($name) || empty($email) || empty($password) || empty($designation) || empty($department)) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in all fields.';
    } else {
        // Check if the email already exists in the database
        $query = "SELECT * FROM register WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $response['status'] = 'error';
            $response['message'] = 'Email already exists. Please use a different email.';
        } else {
            // Handle Profile Image Upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                // Define the upload directory
                $upload_dir = '../uploads/'; 
                $profile_image = $upload_dir . time() . '_' . basename($_FILES['profile_image']['name']);
                $upload_path = $profile_image; // Save the full path in DB

                // Move uploaded file to the uploads directory
                if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
                    $profile_image = $default_profile_image; // Use default if upload fails
                }
            } else {
                $profile_image = $default_profile_image; // Assign default if no file is uploaded
            }

            // Hash the password for security
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database with full image path
            $insert_query = "INSERT INTO register (bioid, name, email, password, designation, profile_image, departmet, usertype) 
                             VALUES ('$bioid', '$name', '$email', '$password', '$designation', '$profile_image', '$department', '$user_type')";

            if (mysqli_query($conn, $insert_query)) {
                // Get the inserted ID (auto-incremented id)
                $user_id = mysqli_insert_id($conn);

                // On successful registration, store id and name separately in the session
                $_SESSION['user_id'] = $user_id;  
                $_SESSION['user_name'] = $name;   
                $_SESSION['designation'] = $designation;
                $_SESSION['profile_image'] = $profile_image;
                $_SESSION['bioid'] = $bioid;

                $response['status'] = 'success';
                $response['message'] = 'Registration successful!';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error occurred. Please try again later.';
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

// Return the response as JSON
echo json_encode($response);
