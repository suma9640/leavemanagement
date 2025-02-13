<?php
include('db.php'); // Include database connection file

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // SQL query to fetch all holidays
    $query = "SELECT holiday_date, holiday_name FROM holidays";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch all holidays as an associative array
        $holidays = [];
        while ($row = $result->fetch_assoc()) {
            $holidays[] = $row;
        }

        // Return the holiday data as JSON
        echo json_encode($holidays);
    } else {
        // If no holidays are found, return an empty array
        echo json_encode([]);
    }
}
?>
