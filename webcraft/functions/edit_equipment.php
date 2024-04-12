<?php
include_once "../dbConfig/dbconnect.php";

if (isset($_GET['equipment_ID'])) {
    $equipmentID = $_GET['equipment_ID'];
} else {
    echo "Equipment ID is missing.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article = $_POST['article'];
    $deployment = $_POST['deployment'];
    $property_number = $_POST['property_number'];
    $account_code = $_POST['account_code'];
    $total_unit = $_POST['total_unit'];
    $total_value = $_POST['total_value'];
    $year_received = $_POST['year_received'];
    $remarks = $_POST['remarks'];
    $description = $_POST['description'];
    $instruction = $_POST['instruction'];

    $sql = "UPDATE equipment SET 
                article = ?,
                deployment = ?,
                property_number = ?,
                account_code = ?,
                total_unit = ?,
                total_value = ?,
                year_received = ?,
                remarks = ?,
                description = ?,
                instruction = ?
            WHERE equipment_ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssississssi", $article, $deployment, $property_number, $account_code, $total_unit, $total_value, $year_received, $remarks, $description, $instruction, $equipmentID);

    if ($stmt->execute()) {
        header("Location: equip_other_info.php?id={$userID}");
        exit();
    } else {
        echo "Error updating equipment information. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>
