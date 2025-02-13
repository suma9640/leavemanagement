<?php
// Include the database connection and start the session
include('../api/db.php');
session_start(); // Start the session

// Check if user is logged in
if (isset($_SESSION['bioid'])) {
    $userId = $_SESSION['bioid']; // Retrieve user_id from session

    // Check if it's a GET or POST request
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Fetch user information
        $query = "SELECT * FROM emloyee WHERE employee_bio_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId); // Bind the user_id parameter
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode([
                'name' => $user['employee_name'],
                'designation' => $user['employee_designation'],
                'department' => $user['employee_department'],
                'email' => $user['employee_email'],
                'bio' => $user['employee_bio_id'],
                'profile_picture' => $user['employee_image'] // Assuming it's stored as a URL or file path
            ]);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    }

    // Handle POST request for profile update
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get POST data
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $department = $_POST['department'];
        $bio = $_POST['bio'];
        $email=$_POST['email'];

        // Handle the profile image (if present)
        $profileImage = null;
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $profileImage = 'uploads/' . $_FILES['profile_image']['name'];
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $profileImage);
        }

        // Update user data in the database
        $query = "UPDATE emloyee SET employee_name = ?,employee_email = ?, employee_designation = ?, employee_department = ?, employee_bio_id = ?, employee_image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $name,$email, $designation, $department, $bio, $profileImage, $userId);

        if ($stmt->execute()) {
            echo json_encode([
                'name' => $name,
                'designation' => $designation,
                'department' => $department,
                'email' => $email, // Assuming user email is stored in session
                'bio' => $bio,
                'profile_picture' => $profileImage
            ]);
        } else {
            echo json_encode(['error' => 'Failed to update profile']);
        }
    }
} else {
    echo json_encode(['error' => 'User not logged in']);
}
?>
