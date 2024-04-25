<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";
include_once "../../functions/header.php";

$equipment_ID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;

function getUserUnitInfo($conn, $article) {
    $userInfo = array();
    $sql = "SELECT user, units_handled FROM user_unit WHERE article = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $article);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userInfo[] = array(
                'user' => $row['user'],
                'units_handled' => $row['units_handled']
            );
        }
    }
    return $userInfo;
}

$sql = "SELECT * FROM equipment WHERE equipment_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $equipment_ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageFilename = $row['image'];
    $imageURL = "../uploads/" . $imageFilename;
    // $user = $row['user'];
    $article = $row['article'];
    $deployment = $row['deployment'];
    $property_number = $row['property_number'];
    $account_code = $row['account_code'];
    $units = $row['total_unit'];
    $unit_value = $row['unit_value'];
    $total_value = $row['total_value'];
    $remarks = $row['remarks'];
    $description = $row['description'];
    $instruction = $row['instruction'];

    $userInfo = getUserUnitInfo($conn, $article);
} else {
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