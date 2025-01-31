<?php
// Start the session
session_start();

// Include the database connection file
require_once('db.php');

// Check if the AJAX request contains the necessary data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data from AJAX request, checking if the keys exist
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $bioid = isset($_POST['bioid']) ? $_POST['bioid'] : ''; // bioid can be used to fetch the user_id
    $designation = isset($_POST['designation']) ? $_POST['designation'] : '';
    $leaveStart = isset($_POST['leaveStart']) ? $_POST['leaveStart'] : '';
    $leaveEnd = isset($_POST['leaveEnd']) ? $_POST['leaveEnd'] : null; // Optional end date, defaulting to null
    $numDays = isset($_POST['numDays']) ? $_POST['numDays'] : '';
    $dateOfApplication = isset($_POST['dateOfApplication']) ? $_POST['dateOfApplication'] : '';
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';

    // Validate the data (for example, check if any required fields are empty)
    if (empty($name) || empty($bioid) || empty($designation) || empty($leaveStart) || empty($numDays) || empty($dateOfApplication) || empty($reason) || empty($department)) {
        echo json_encode(array('status' => 'error', 'message' => 'All fields are required.'));
        exit();
    }

    // If leaveEnd is not provided, set it to the start date
    if (!$leaveEnd) {
        $leaveEnd = $leaveStart;
    }

    // Define the status variable here
    $status = 'pending';

    // Check if the user is logged in and the user_id exists in the session
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];  // Get the user_id from the session

        // Prepare the SQL query to insert data into the database
        $query = "INSERT INTO applyleave (user_id, name, bioid, designation, dateleavesought_from, dateleavesought_to, noofdays, reason, department, dateofapplication, status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Bind the parameters (including user_id)
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("issssssssss", $userId, $name, $bioid, $designation, $leaveStart, $leaveEnd, $numDays, $reason, $department, $dateOfApplication, $status);

            // Execute the query
            if ($stmt->execute()) {
                echo json_encode(array(
                    'status' => 'success', 
                    'message' => 'Leave application submitted successfully.',
                    'data' => array(
                        'name' => $name,
                        'bioid' => $bioid,
                        'designation' => $designation,
                        'leaveStart' => $leaveStart,
                        'leaveEnd' => $leaveEnd,
                        'numDays' => $numDays,
                        'dateOfApplication' => $dateOfApplication,
                        'reason' => $reason,
                        'department' => $department
                    )
                ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to submit the application. Please try again.'));
            }

            $stmt->close();
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Database query error.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'User not logged in. Session expired or invalid.'));
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}
?>
