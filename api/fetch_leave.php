<?php
// Start the session
session_start();

// Check if the user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // If not, return an error message
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Include database connection
include('db.php');

// Check if leaveType is passed via GET request
if (isset($_GET['leaveType'])) {
    $leaveType = $_GET['leaveType'];

    // Prepare the SQL query to fetch leave data for the user based on leaveType
    $sql = "SELECT leaveType, noofdays FROM applyleave WHERE user_id = $user_id AND leaveType = '$leaveType'";

    // Execute the query
    $result = $conn->query($sql);

    // Initialize an empty array to hold leave data
    $leave_data = array();

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Fetch the result row and store leave data
        while ($row = $result->fetch_assoc()) {
            $leave_data[] = [
                'leaveType' => $row['leaveType'],
                'noofdays' => $row['noofdays']
            ];
        }
        // Return the fetched leave data as a JSON response
        echo json_encode(['leaveData' => $leave_data]);
    } else {
        // If no data is found for the given leave type, return an error
        echo json_encode(['error' => 'No data found for the specified leave type']);
    }

} else {
    // If leaveType is not specified in the GET request, return an error
    echo json_encode(['error' => 'Leave type not specified']);
}

// Close the database connection
$conn->close();
?>
