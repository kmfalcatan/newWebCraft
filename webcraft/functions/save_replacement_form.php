<?php
include "../dbConfig/dbconnect.php";
include "../functions/header.php";
include "../authentication/auth.php";

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
            $stmt->close();
            $success_message = "Replacement form submitted successfully.";
        } else {
            $error_message = "Error submitting replacement form: " . $stmt->error;
        }
    }

    if (!empty($success_message)) {
        header("Location: ../templates/userPanel/bin.php?id={$userID}&success_message={$success_message}");
        exit;
    } else {
        header("Location: ../templates/userPanel/bin.php?id={$userID}&error_message={$error_message}");
        exit;
    }
}
?>

<!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
    *Administartive Office Facility Reservation and Management System*
    *IT 132 - Software Engineering *
    *(WebCraft) Members:
        Falcatan, Khriz Marr
        Gabotero, Rogie
        Taborada, John Mark
        Tingkasan, Padwa 
        Villares, Arp-J* -->