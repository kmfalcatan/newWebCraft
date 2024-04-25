<?php
include "../dbConfig/dbconnect.php";
include_once "../functions/header.php";
include_once "../authentication/auth.php";

$equipmentID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $equipmentID = $_POST['equipment_ID'];
    $article = $_POST['article'];
    $deployment = $_POST['deployment'];
    $propertyNumber = $_POST['property_number'];
    $accountCode = $_POST['account_code'];
    $totalUnit = $_POST['total_unit'];
    $totalValue = $_POST['total_value'];
    $yearReceived = $_POST['year_received'];
    $remarks = $_POST['remarks'];
    $description = $_POST['description'];
    $instruction = $_POST['instruction'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = $_FILES['image']['name'];
        $image = $filename;
        move_uploaded_file($tmp_name, '../uploads/' . $image);
    } else {
        
        $stmt_select_image = $conn->prepare("SELECT image FROM equipment WHERE equipment_ID = ?");
        $stmt_select_image->bind_param("i", $equipmentID);
        $stmt_select_image->execute();
        $stmt_select_image->bind_result($image);
        $stmt_select_image->fetch();
        $stmt_select_image->close();
    }

    $stmt = $conn->prepare("UPDATE equipment SET article=?, deployment=?, property_number=?, account_code=?, total_unit=?, total_value=?, year_received=?, remarks=?, description=?, instruction=?, image=? WHERE equipment_ID = ? ");

    $stmt->bind_param("ssssiiissssi", $article, $deployment, $propertyNumber, $accountCode, $totalUnit, $totalValue, $yearReceived, $remarks, $description, $instruction, $image, $equipmentID);
    
    if ($stmt->execute()) {
        $success_message = "Equipment details updated successfully";
        header("Location: ../templates/adminPanel/equip_other_info.php?id={$userID}&equipment_ID={$equipmentID}&success_message={$success_message}");
        exit();
    } else {
        $error_message = "Error updating data: " . $stmt->error;
        header("Location: ../templates/adminPanel/equip_other_info.php?id={$userID}&equipment_ID={$equipmentID}&error_message={$error_message}");
        exit();
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
