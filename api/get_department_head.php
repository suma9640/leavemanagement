<?php
// Include the database connection file
require_once('db.php');  // Update path as needed

// Check if 'department' is passed in the GET request
if (isset($_GET['department'])) {
    $department = $_GET['department'];

    // Prepare the query to get the department head based on the selected department
    $query = "SELECT department_head FROM department WHERE department_name = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind the department parameter to the query
        $stmt->bind_param("s", $department);
        
        // Execute the query
        if ($stmt->execute()) {
            // Fetch the result
            $stmt->bind_result($departmentHead);
            if ($stmt->fetch()) {
                // Return the department head as a JSON response
                echo json_encode(array('status' => 'success', 'departmentHead' => $departmentHead));
            } else {
                // Department not found
                echo json_encode(array('status' => 'error', 'message' => 'Department not found.'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error executing query.'));
        }
        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Database query preparation failed.'));
    }

    // Close the database connection
    $conn->close();
} else {
    // If no department parameter is provided
    echo json_encode(array('status' => 'error', 'message' => 'No department selected.'));
}
?>
