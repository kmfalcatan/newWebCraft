<?php
include "../dbConfig/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_ID = $_POST['user_ID'] ?? '';
    $equipmentID = $_POST['equipment_ID'] ?? '';
    $unitID = $_POST['unit_ID'] ?? ''; 
    $unit_cost = $_POST['unit_cost'] ?? '';
    $unit_specs = $_POST['unit_specs'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $replacement_date = $_POST['replacement_date'] ?? '';

    $query = "INSERT INTO unit_replacement (user_ID, equipment_ID, unit_ID, unit_cost, unit_specs, first_name, last_name, email, designation, replacement_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iissssssss", $user_ID, $equipmentID, $unitID, $unit_cost, $unit_specs, $first_name, $last_name, $email, $designation, $replacement_date);

        if ($stmt->execute()) {
            echo "<script>alert('Data successfully inserted');</script>";
        } else {
            echo "<script>alert('Error inserting data');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement');</script>";
    }
}
?>
