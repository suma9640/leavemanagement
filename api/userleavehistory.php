<?php
// Assuming you have a valid database connection already established
session_start();
include('db.php');
if (isset($_GET['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Prepare the query to fetch leave applications for the given user_id
    $query = "SELECT * FROM applyleave WHERE user_id = ?";

    // Check if the query can be prepared
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $userId); // Bind the user_id parameter
        $stmt->execute();
        $result = $stmt->get_result();

        $leaveApplications = [];

        // Fetch the results and store them in an array
        while ($row = $result->fetch_assoc()) {
            $leaveApplications[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'designation' => $row['designation'],
                'bio_id' => $row['bioid'],
                'leave_from' => $row['dateleavesought_from'],
                'leave_to' => $row['dateleavesought_to'],
                'no_of_days' => $row['noofdays'],
                'application_date' => $row['dateofapplication'],
                'reason' => $row['reason'],
                'status' => $row['status']
            ];
        }

        // Return the leave applications as a JSON response
        echo json_encode($leaveApplications);

        $stmt->close();
    } else {
        echo json_encode(['message' => 'Database query error.']);
    }
} else {
    echo json_encode(['message' => 'Missing user_id parameter.']);
}

$conn->close();
?>
