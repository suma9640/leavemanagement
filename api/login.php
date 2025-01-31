<?php
session_start();

// Include database connection file
require_once('db.php');

// Create an array to store the response
$response = array();

// Check if the form was submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data and sanitize it
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    // Validate inputs
    if (empty($email) || empty($password)) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in both email and password!';
    } else {
        // Check if the email exists in the database
        $query = "SELECT * FROM register WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Fetch user data
            $user = mysqli_fetch_assoc($result);

            // Debugging: Check user data (remove in production)
            // var_dump($user);

            // Verify the password (use password_verify if it's hashed)
            if (password_verify($password, $user['password'])) {
                // Store the necessary data in the session
                $_SESSION['user_id'] = $user['id'];  // Store user id in session
                $_SESSION['email'] = $user['email'];  // Store email in session
                
                // Return success message
                $response['status'] = 'success';
                $response['message'] = 'Login successful!';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Invalid password!';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Email not found!';
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method. Please use POST.';
}

// Close the database connection
mysqli_close($conn);

// Return the response as JSON
echo json_encode($response);
?>
