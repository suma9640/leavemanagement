<?php
// Assuming you have a valid database connection already established
include('db.php');
// Query to count the number of rejected leave applications
$query = "SELECT COUNT(*) AS rejected_leave_count FROM applyleave WHERE status = 'rejected'"; // Adjust the table and status as necessary

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $rejectedLeaveCount = $row['rejected_leave_count'];
    echo json_encode(['count' => $rejectedLeaveCount]);
} else {
    echo json_encode(['error' => 'Error fetching rejected leave count.']);
}

$conn->close();
?>
