<?php
session_start();
include 'db.php';  // Your database connection file

// Function to check if the user is an admin (replace with your actual logic)
function isAdmin($userId) {
    global $conn;
    // Example: Check if the user's role is 'admin' in the 'users' table
    $stmt = $conn->prepare("SELECT usertype FROM register WHERE id = ?"); // Adjust table and column names as needed
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['usertype'] === 'admin'; // Or whatever your admin role is
    }
    return false; // User not found or not an admin
}

// Check if user is logged in AND is an admin
if (!isset($_SESSION['user_id']) || !isAdmin($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST['bioid'];
    $clBalanceAdjust = $_POST['cl_balance'];
    $slBalanceAdjust = $_POST['sl_balance'];

    // Input Validation (Important!)
    if (!is_numeric($employeeId) || $employeeId <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid employee ID.']);
        exit();
    }
    if (!is_numeric($clBalanceAdjust) || !is_numeric($slBalanceAdjust)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid leave balance adjustments.']);
        exit();
    }


    // 1. Get current balances (and check if employee exists)
    $getBalanceQuery = "SELECT cl_balance, sl_balance FROM leave_balances WHERE employee_id = ?";
    $getBalanceStmt = $conn->prepare($getBalanceQuery);
    $getBalanceStmt->bind_param("i", $employeeId);
    $getBalanceStmt->execute();
    $balanceResult = $getBalanceStmt->get_result();

    if ($balanceResult->num_rows == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Employee not found.']);
        exit();
    }

    $row = $balanceResult->fetch_assoc();
    $currentCL = $row['cl_balance'];
    $currentSL = $row['sl_balance'];

    // 2. Calculate new balances (handle potential negative balances if needed)
    $newCL = $currentCL + $clBalanceAdjust;
    $newSL = $currentSL + $slBalanceAdjust;

    // Optional: Check for negative balances and handle them as needed
    if ($newCL < 0 || $newSL < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Leave balance cannot be negative.']);
        exit();
    }


    // 3. Update the leave_balances table
    $updateQuery = "UPDATE leave_balances SET cl_balance = ?, sl_balance = ? WHERE bioid = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ddi", $newCL, $newSL, $employeeId);

    if ($updateStmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Leave balances updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating leave balances: ' . $updateStmt->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();
?>