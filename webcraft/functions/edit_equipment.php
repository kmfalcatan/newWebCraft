<?php
function updateEquipment($equipmentID) {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmSave'])) {
        $article = $_POST['article'];
        $deployment = $_POST['deployment'];
        $propertyNumber = $_POST['property_number'];
        $accountCode = $_POST['account_code'];
        $unitValue = $_POST['unit_value'];
        $remarks = $_POST['remarks'];
        $description = $_POST['description'];
        $instruction = $_POST['instruction'];

        $query = "UPDATE equipment SET
                  article = '$article',
                  deployment = '$deployment',
                  property_number = '$propertyNumber',
                  account_code = '$accountCode',
                  unit_value = '$unitValue',
                  remarks = '$remarks',
                  description = '$description',
                  instruction = '$instruction'
                  WHERE equipment_ID = '$equipmentID'";

        $userID = $_SESSION['user_id'];
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: inventory.php?equipment_ID=$equipmentID&user_ID=$userID");
        } else {
            echo "Error updating equipment information: " . mysqli_error($conn);
        }
    }
}

if (isset($_GET['equipment_ID'])) {
    $equipmentID = $_GET['equipment_ID'];
    updateEquipment($equipmentID);
}
?>