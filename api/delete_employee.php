<?php
// delete_employee.php

// Check if the 'id' is received via POST
if (isset($_POST['id'])) {
    $employeeId = $_POST['id'];

   include('db.php');

    // SQL query to delete the employee from the database
    $sql = "DELETE FROM emloyees WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter (i = integer)
        $stmt->bind_param("i", $employeeId);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting employee: ' . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    }

    // Close the connection
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No employee ID provided']);
}
?>
