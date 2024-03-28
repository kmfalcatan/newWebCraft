<?php
include "../dbConfig/dbconnect.php";
include_once "../functions/header.php";
include_once "../authentication/auth.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmSave'])) {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleInitial = $_POST['middle_initial'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $profile_img = '';
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['profile_img']['tmp_name'];
        $filename = $_FILES['profile_img']['name'];
        $profile_img = $filename;
        move_uploaded_file($tmp_name, '../uploads/' . $profile_img);
    }

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, middle_initial=?, designation=?, department=?, email=?, address=?, gender=?, profile_img=? WHERE user_ID = '$userID'");

    $stmt->bind_param("sssssssss", $firstName, $lastName, $middleInitial, $designation, $department, $email, $address, $gender, $profile_img);

    if ($stmt->execute()) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    $stmt->close();

    $userID = $_SESSION['user_id'];
    $userInfo = getUserInfo($conn, $userID);
    $role = $userInfo['role'];

    if ($role === 'admin') {
        header("Location: ../templates/adminPanel/my_profile.php?id={$userID}");
    } else {
        header("Location: ../templates/userPanel/my_profile.php?id={$userID}");
        exit();
    }
}
?>  