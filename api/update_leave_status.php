<?php
// Include the database connection file
require_once('db.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from POST request
    $leaveId = isset($_POST['id']) ? $_POST['id'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    // Validate the input
    if (empty($leaveId) || empty($status)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
        exit();
    }

    // Update the status of the leave application
    $query = "UPDATE applyleave SET status = ? WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters and execute the query
        $stmt->bind_param("si", $status, $leaveId);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Leave status updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update leave status.']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database query error.']);
    }

    // Close the database connection
    $conn->close();
}
?>
