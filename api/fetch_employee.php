<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header to application/json
header('Content-Type: application/json');

include('db.php');
// Query to fetch employee data
$query = "SELECT * FROM register WHERE usertype='user'";
$result = $conn->query($query);

// Check if data exists
if ($result->num_rows > 0) {
    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    // Output the employee data as JSON
    echo json_encode($employees);
} else {
    // If no data found, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
