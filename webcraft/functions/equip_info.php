<?php
include_once "../../functions/header.php";
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";

$equipmentID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;

$sql = "SELECT * FROM equipment WHERE equipment_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $equipmentID);
$stmt->execute();
$result = $stmt->get_result();
    
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageFilename = $row['image'];
    $imageURL = "../uploads/" . $imageFilename;
    $article = $row['article'];
    $deployment = $row['deployment'];
    $propertyNumber = $row['property_number'];
    $accountCode = $row['account_code'];
    $units = $row['total_unit'];
    $unitValue = $row['unit_value'];
    $totalValue = $row['total_value'];
    $remarks = $row['remarks'];
    $description = $row['description'];
    $instruction = $row['instruction'];
    $yearReceived = $row['year_received'];

    $equipInfo = getEquipInfo($conn, $article);
} else {
}

function getEquipInfo($conn, $article) {
    $equipInfo = array();
    $sql = "SELECT user, units_handled FROM user_unit WHERE article = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $article);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $equipInfo[] = array(
                'user' => $row['user'],
                'units_handled' => $row['units_handled']
            );
        }
    }
    return $equipInfo;
}

$sql = "SELECT warranty_end FROM equipment WHERE equipment_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $equipmentID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $warranty_end = $row['warranty_end'];
    if ($warranty_end == '0000-00-00') {
        $warranty_status = "No warranty available";
        $text_color = "inherit"; 
    } elseif (!empty($warranty_end)) {
        if (strtotime($warranty_end) > time()) {
            $warranty_status = "Active";
            $text_color = "green"; 
        } else {
            $warranty_status = "Expired";
            $text_color = "red";
        }
    } else {
        $warranty_status = "No warranty available";
        $text_color = "inherit"; 
    }
} else {
    $warranty_end = "No warranty expiration information available.";
    $warranty_status = "No warranty available";
    $text_color = "inherit"; 
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