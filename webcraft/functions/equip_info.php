<?php

$equipment_ID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;

$sql = "SELECT * FROM equipment WHERE equipment_ID = '$equipment_ID'";
$result = $conn->query($sql);
    
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageFilename = $row['image'];
    $imageURL = "../uploads/" . $imageFilename;
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

function getUserUnitInfo($conn, $article) {
    $userInfo = array();
    $sql = "SELECT user, units_handled FROM user_unit WHERE article = '$article'";
    $result = $conn->query($sql);
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
?>