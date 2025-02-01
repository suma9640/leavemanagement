<?php
// Assuming you have a valid database connection already established
include('db.php');
// Query to count the number of pending leave applications
$query = "SELECT COUNT(*) AS pending_leave_count FROM applyleave WHERE status = 'pending'"; // Adjust the table and status as necessary

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $pendingLeaveCount = $row['pending_leave_count'];
    echo json_encode(['count' => $pendingLeaveCount]);
} else {
    echo json_encode(['error' => 'Error fetching pending leave count.']);
}

$conn->close();
?>
