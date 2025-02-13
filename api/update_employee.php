<?php
// update_employee.php

// Check if form data is received
if (isset($_POST['employeeId'])) {
    $employeeId = $_POST['employeeId'];
    $employeeName = $_POST['employeeName'];
    $employeeEmail = $_POST['employeeEmail'];
    $employeeDepartment = $_POST['employeeDepartment'];
    $employeeDesignation = $_POST['employeeDesignation'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = null; // Handle case where image isn't uploaded
    }

    // Handle ID proof upload
    if (isset($_FILES['id_proof']) && $_FILES['id_proof']['error'] == 0) {
        $idProofPath = 'uploads/' . basename($_FILES['id_proof']['name']);
        move_uploaded_file($_FILES['id_proof']['tmp_name'], $idProofPath);
    } else {
        $idProofPath = null; // Handle case where ID proof isn't uploaded
    }

   include('db.php');

    // Update the employee in the database (using MySQLi prepared statements)
    $sql = "UPDATE emloyee SET 
                employee_name = ?, 
                employee_email = ?, 
                employee_department = ?, 
                employee_designation = ?, 
                employee_image = ?, 
                id_proof_image = ? 
            WHERE id = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters (s = string, i = integer)
        $stmt->bind_param("ssssssi", $employeeName, $employeeEmail, $employeeDepartment, $employeeDesignation, $imagePath, $idProofPath, $employeeId);

        // Execute statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating employee: ' . $stmt->error]);
        }

        // Close statement
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    }

    // Close connection
    $conn->close();
}
?>
