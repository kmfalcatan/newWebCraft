<?php
include '../dbConfig/dbconnect.php';
include '../authentication/auth.php';
include '../functions/header.php';

function saveUserUnit($conn, $article, $enduser, $unitsHandled) {
    $query = "INSERT INTO user_unit (article, user, units_handled) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $article, $enduser, $unitsHandled);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
    return true;
}

function saveEquipment($conn, $article, $deployment, $property_number, $account_code, $unit_value, $total_value, $remarks, $description, $year_received, $warranty_start, $warranty_end, $warranty_image, $total_unit, $instruction, $image, $selectedUsers, $unitsHandledArray) {

    $query = "INSERT INTO equipment (article, deployment, property_number, account_code, unit_value, total_value, remarks, description, year_received, warranty_start, warranty_end, warranty_image, total_unit, instruction, image) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssssssssssiss", $article, $deployment, $property_number, $account_code, $unit_value, $total_value, $remarks, $description, $year_received, $warranty_start, $warranty_end, $warranty_image, $total_unit, $instruction, $image);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return false;
    }

    $equipment_ID = $conn->insert_id;

    $unit_id = 1; 
    foreach ($selectedUsers as $key => $enduser) {
        $unitsHandled = $unitsHandledArray[$key] ?? '';

        for ($i = 0; $i < $unitsHandled; $i++) {
            $insert_unit_sql = "INSERT INTO units (equipment_ID, equipment_name, user) 
                                VALUES ('$equipment_ID', '$article', '$enduser')";
            if ($conn->query($insert_unit_sql) !== TRUE) {
                echo "Error: " . $insert_unit_sql . "<br>" . $conn->error;
            }
            $unit_id++;
        }
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article = $_POST['article'] ?? '';
    $deployment = $_POST['deployment'] ?? '';
    $property_number = $_POST['property_number'] ?? '';
    $account_code = $_POST['account_code'] ?? '';
    $unit_value = $_POST['unit_value'] ?? '';
    $total_value = $_POST['total_value'] ?? '';
    $remarks = $_POST['remarks'] ?? '';
    $description = $_POST['description'] ?? '';
    $year_received = $_POST['year_received'] ?? '';
    $warranty_start = $_POST['warranty_start'] ?? '';
    $warranty_end = $_POST['warranty_end'] ?? '';
    $total_unit = $_POST['total_unit'] ?? '';
    $instruction = $_POST['instruction'] ?? '';

    $warranty_image = '';
    if (isset($_FILES['warranty_image']) && $_FILES['warranty_image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['warranty_image']['tmp_name'];
        $filename = $_FILES['warranty_image']['name'];
        $warranty_image = $filename;
        move_uploaded_file($tmp_name, '../uploads/' . $warranty_image); 
    }
    
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = $_FILES['image']['name'];
        $image = $filename;
        move_uploaded_file($tmp_name, '../uploads/' . $image); 
    }    

    $unitsHandledArray = $_POST['units_handled'] ?? '';
    $selectedUsers = $_POST['user'] ?? [];

    $success = saveEquipment($conn, $article, $deployment, $property_number, $account_code, $unit_value, $total_value, $remarks, $description, $year_received, $warranty_start, $warranty_end, $warranty_image, $total_unit, $instruction, $image, $selectedUsers, $unitsHandledArray);

    if ($success) {
        foreach ($selectedUsers as $key => $enduser) {
            $unitsHandled = $unitsHandledArray[$key] ?? '';

            $userUnitSuccess = saveUserUnit($conn, $article, $enduser, $unitsHandled);

            if (!$userUnitSuccess) {
                echo "Error occurred while saving user unit information.";
            }
        }

        $userID = $_SESSION['user_id'];
        $userInfo = getUserInfo($conn, $userID);
        $role = $userInfo['role'];
    
        if ($role === 'admin') {
            header("Location: ../templates/adminPanel/inventory.php?equipment_ID={$equipment_ID}&id={$userID}");
            exit();
        }
    } else {
        echo "Error occurred while saving equipment information.";
    }
}
?>
