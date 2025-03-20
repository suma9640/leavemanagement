<?php
// Assuming you have a valid database connection already established
include('db.php');
// Query to count the number of employees
$query = "SELECT COUNT(*) AS employee_count FROM register";

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $employeeCount = $row['employee_count'];
    echo json_encode(['count' => $employeeCount]);
} else {
    echo json_encode(['error' => 'Error fetching employee count.']);
}

$conn->close();
?>
