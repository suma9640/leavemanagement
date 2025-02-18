<?php
session_start();
include('db.php'); // Your database connection

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query = "SELECT name, designation, departmet, email, bioid, profile_image FROM register WHERE id = ?"; // Corrected column names (important!)
        $stmt = $conn->prepare($query);

        
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'name' => $user['name'],
                    'designation' => $user['designation'],
                    'department' => $user['departmet'],
                    'email' => $user['email'],
                    'bio' => $user['bioid'],
                    'profile_picture' => $user['profile_image']
                ]
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $department = $_POST['department'];
        $bio = $_POST['bio'];
        $email = $_POST['email'];

        $profileImage = null;
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $targetDir = "../uploads/";  // Make sure this directory exists and has correct permissions
            $profileImage = $targetDir . basename($_FILES['profile_image']['name']);
            if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $profileImage)) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
                exit(); // Stop execution on image upload failure
            }
        }

        $query = "UPDATE register SET name = ?, email = ?, designation = ?, departmet = ?, bioid = ?, profile_image = ? WHERE id = ?"; // Corrected column names
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $name, $email, $designation, $department, $bio, $profileImage, $userId);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'name' => $name,
                    'designation' => $designation,
                    'department' => $department,
                    'email' => $email,
                    'bio' => $bio,
                    'profile_picture' => $profileImage
                ]
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update profile: ' . $stmt->error]);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
}

$conn->close(); // Close the database connection
?>