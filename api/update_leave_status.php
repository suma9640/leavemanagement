<?php
// Assuming you have a valid database connection already established
include('db.php');
// Check if the required POST parameters are set
if (isset($_POST['id']) && isset($_POST['status'])) {
    $leaveId = $_POST['id'];
    $status = $_POST['status'];

    // Validate status to prevent invalid values (optional)
    if ($status !== 'approved' && $status !== 'rejected') {
        echo json_encode(['message' => 'Invalid status.']);
        exit();
    }

    // Prepare the query to update the leave status in the database
    $query = "UPDATE applyleave SET status = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('si', $status, $leaveId);

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Leave status updated successfully.']);
        } else {
            echo json_encode(['message' => 'Failed to update leave status.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['message' => 'Database query error.']);
    }
} else {
    echo json_encode(['message' => 'Missing required parameters.']);
}

$conn->close();
?>
