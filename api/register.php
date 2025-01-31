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
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_type = 'user';  // Default user type (can be changed if needed)

    // Check if the fields are empty
    if (empty($name) || empty($email) || empty($password)) {
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
            // Hash the password
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the data into the database
            $insert_query = "INSERT INTO register (name, email, password, usertype) VALUES ('$name', '$email', '$password', '$user_type')";
            if (mysqli_query($conn, $insert_query)) {
                // Get the inserted ID (auto-incremented id)
                $user_id = mysqli_insert_id($conn);

                // On successful registration, store id and name separately in the session
                $_SESSION['user_id'] = $user_id;  // Store the generated user ID
                $_SESSION['user_name'] = $name;   // Store the user's name

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
