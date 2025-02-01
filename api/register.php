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
    $user_type = 'user';  // Default user type

    // Default profile image
    $profile_image = 'default-profile.jpg';

    // Check if the fields are empty
    if (empty($bioid) || empty($name) || empty($email) || empty($password) || empty($designation)) {
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
                $profile_image = time() . '_' . $_FILES['profile_image']['name'];
                $upload_path = $upload_dir . $profile_image;

                // Move uploaded file to the uploads directory
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
                    // File uploaded successfully
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Error uploading the profile image.';
                    echo json_encode($response);
                    exit;
                }
            }

            // Hash the password for security
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the data into the database
            $insert_query = "INSERT INTO register (bioid, name, email, password, designation, profile_image, usertype) 
                             VALUES ('$bioid', '$name', '$email', '$password', '$designation', '$profile_image', '$user_type')";

            if (mysqli_query($conn, $insert_query)) {
                // Get the inserted ID (auto-incremented id)
                $user_id = mysqli_insert_id($conn);

                // On successful registration, store id and name separately in the session
                $_SESSION['user_id'] = $user_id;  // Store the generated user ID
                $_SESSION['user_name'] = $name;   // Store the user's name
                $_SESSION['designation']=$designation;
                $_SESSION['profile_image']=$profile_image;

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
?>
