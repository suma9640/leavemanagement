<?php
// Include the database connection
require_once('db.php');

// Array to store response
$response = array();

$query = "SELECT DISTINCT department_name FROM department";  // Using DISTINCT for unique department names

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $response['status'] = 'success';  // Add status message
    $response['message'] = 'Departments fetched successfully';  // Add success message

    // Fetch and send departments as JSON response
    while ($row = mysqli_fetch_assoc($result)) {
        $response['data'][] = $row;  // Append data to 'data' key
    }
} else {
    $response['status'] = 'error';  // If no departments found
    $response['message'] = 'No departments found.';
}

// Close the database connection
mysqli_close($conn);

// Return the response as JSON
echo json_encode($response);
?>
