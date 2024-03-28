<?php
include_once '../dbConfig/dbconnect.php';

if(isset($_GET['equipment_ID'])) {
    $equipment_ID = $_GET['equipment_ID'];

    $sql = "SELECT warranty_end FROM equipment WHERE equipment_ID = $equipment_ID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $warranty_end = $row['warranty_end'];
    } else {
        $warranty_end = "No warranty expiration information available.";
    }
} else {
    $warranty_end = "Equipment ID not provided.";
}
?>