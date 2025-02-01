<?php
// Assuming you have a valid database connection already established
include('db.php');
// Query to count the number of departments
$query = "SELECT COUNT(*) AS department_count FROM department"; // Replace 'departments' with your actual table name

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $departmentCount = $row['department_count'];
    echo json_encode(['count' => $departmentCount]);
} else {
    echo json_encode(['error' => 'Error fetching department count.']);
}

$conn->close();
?>
