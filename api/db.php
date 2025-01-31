<?php
// Database configuration
$host = 'localhost';        // Your database host (usually localhost)
$dbname = 'leavemanagement';  // Your database name
$username = 'root';         // Your database username (typically 'root' for local development)
$password = '';             // Your database password (empty for local development)

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    // If there is a connection error, display it
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment below to confirm connection
// echo 'Database connection successful!';

// Return the connection object so it can be used in other files
return $conn;
?>
