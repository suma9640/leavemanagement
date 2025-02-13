
<?php
include('db.php');

if (isset($_GET['id'])) {
    // Fetch a specific employee by ID
    $employeeId = $_GET['id'];
    $sql = "SELECT * FROM emloyee WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();

    echo json_encode($employee);
} else {
    // Fetch all employees
    $sql = "SELECT * FROM emloyee";
    $result = $conn->query($sql);

    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }

    echo json_encode($employees);
}

$conn->close();
?>