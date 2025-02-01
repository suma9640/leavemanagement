<?php
// Assuming you have a valid database connection already established
include('db.php');
// Query to count the number of accepted leave applications
$query = "SELECT COUNT(*) AS accepted_leave_count FROM applyleave WHERE status = 'approved'"; // Adjust the table and status as necessary

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $acceptedLeaveCount = $row['accepted_leave_count'];
    echo json_encode(['count' => $acceptedLeaveCount]);
} else {
    echo json_encode(['error' => 'Error fetching accepted leave count.']);
}

$conn->close();
?>
