<?php
// Include the database connection file
require_once('db.php');

// Fetch leave applications from the database
$query = "SELECT * FROM applyleave WHERE status = 'pending'";
$result = $conn->query($query);

$leaveApplications = [];
while ($row = $result->fetch_assoc()) {
    $leaveApplications[] = $row;
}

// Return the leave applications as JSON
echo json_encode($leaveApplications);

// Close the database connection
$conn->close();
?>
