<?php
session_start();
include('db.php');

header('Content-Type: application/json');

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bioid = $_POST['bioid'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validation check
    if (empty($bioid) || empty($password)) {
        echo json_encode([
            "status" => "error",
            "message" => "Bio ID and password are required."
        ]);
        exit();
    }

    // Query to check user credentials based on the bioid
    $query = "SELECT * FROM register WHERE bioid = '$bioid'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Direct password comparison (no hashing)
        if ($password === $user['password']) {
            // If the password is correct, get user info based on bioid
            $usertype = $user['usertype']; // Assuming `usertype` is a column in your `register` table
            $id = $user['id']; // User ID, assuming this column exists in your table

            // Set session or token (optional based on your requirements)
            $_SESSION['user_id'] = $id;  // Store user ID in session

            if ($usertype == 'admin') {
                $response = [
                    "status" => "success",
                    "message" => "Admin Login Successfully!!!",
                    "usertype" => "admin",
                    "id" => $id
                ];
            } elseif ($usertype == 'user') {
                $response = [
                    "status" => "success",
                    "message" => "User Login Successfully!!!",
                    "usertype" => "user",
                    "id" => $id
                ];
            } else {
                $response = [
                    "status" => "success",
                    "message" => "Welcome, Guest!",
                    "usertype" => "guest",
                    "id" => $id
                ];
            }
        } else {
            // Incorrect password
            $response = [
                "status" => "error",
                "message" => "Invalid password."
            ];
        }
    } else {
        // User not found
        $response = [
            "status" => "error",
            "message" => "Invalid Bio ID."
        ];
    }

    echo json_encode($response);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method."
    ]);
}

// Close connection
$conn->close();
?>
