<?php
// Include the database connection
include('../api/db.php');
session_start(); // Start the session

// Check if it's a POST request (login attempt)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data for login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the input (optional, but good practice)
    if (empty($email) || empty($password)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email and password are required'
        ]);
        exit;
    }

    // Check the database for matching user
    $query = "SELECT * FROM register WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email); // Bind the email parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the given email exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password (assuming passwords are hashed in the database)
        if (password_verify($password, $user['password'])) {
            // Store user data in session
            $_SESSION['user_id'] = $user['id']; // Save user ID in session
            $_SESSION['email'] = $user['email']; // Save user email in session

            // Respond with success and user data (excluding password)
            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'user_id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'designation' => $user['designation'],
                    'department' => $user['department'],
                    'bio' => $user['bio'],
                    'profile_picture' => $user['profile_image'] // Assuming the profile image is stored as a URL or file path
                ]
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid password'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'User not found'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
