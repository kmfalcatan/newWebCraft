<?php
include '../dbConfig/dbconnect.php';
include '../authentication/auth.php';
include '../functions/header.php';

function saveUserUnit($conn, $equipment_ID, $article, $user_ID, $enduser, $unitsHandled) {
    $query = "INSERT INTO user_unit (equipment_ID, article, user_ID, user, units_handled) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isiss", $equipment_ID, $article, $user_ID, $enduser, $unitsHandled);
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

    foreach ($selectedUsers as $key => $enduser) {
        $unitsHandled = $unitsHandledArray[$key] ?? '';

        $query = "SELECT user_ID FROM users WHERE CONCAT(first_name, ' ', last_name) = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $enduser);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $user_ID = $row['user_ID'];

        for ($i = 0; $i < $unitsHandled; $i++) {
            $insert_unit_sql = "INSERT INTO units (equipment_ID, equipment_name, user_ID, user, year_received) 
                                VALUES ('$equipment_ID', '$article', '$user_ID', '$enduser', '$year_received')";
            if ($conn->query($insert_unit_sql) !== TRUE) {
                echo "Error: " . $insert_unit_sql . "<br>" . $conn->error;
            }
        }

        $userUnitSuccess = saveUserUnit($conn, $equipment_ID, $article, $user_ID, $enduser, $unitsHandled);
        if (!$userUnitSuccess) {
            echo "Error occurred while saving user unit information.";
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
        $userID = $_SESSION['user_id'];
        $userInfo = getUserInfo($conn, $userID);
        $role = $userInfo['role'];
    
        if ($role === 'admin') {
            $success_message = "New equipment saved successfully.";
            header("Location: ../templates/adminPanel/inventory.php?id={$userID}&success_message={$success_message}");
            exit();
        }
    } else {
        $error_message = "Error occurred while saving equipment.";
        header("Location: ../templates/adminPanel/inventory.php?id={$userID}&error_message={$error_message}");
        exit();
    }
}
?>

<!-- *Copyright © 2024 WebCraft - All Rights Reserved*
        *Administartive Office Facility Reservation and Management System*
        *IT 132 - Software Engineering *
        *(WebCraft) Members:
            Falcatan, Khriz Marr
            Gabotero, Rogie
            Taborada, John Mark
            Tingkasan, Padwa 
            Villares, Arp-J* -->
