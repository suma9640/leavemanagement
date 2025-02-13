<?php
include('db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch data from POST
    $holidayDate = $_POST['holidayDate'];
    $holidayName = $_POST['holidayName'];

    // Prepare the SQL query (removed holidayType)
    $stmt = $conn->prepare("INSERT INTO holidays (holiday_date, holiday_name) VALUES (?, ?)");

    if ($stmt === false) {
        die('Error preparing statement: ' . $mysqli->error);
    }

    // Bind the parameters (only two values now)
    $stmt->bind_param("ss", $holidayDate, $holidayName); // Two string parameters

    // Execute the statement
    if ($stmt->execute()) {
        echo "Holiday added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
