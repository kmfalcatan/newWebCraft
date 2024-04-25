<?php
include "../dbConfig/dbconnect.php";
include_once "../functions/header.php";
include_once "../authentication/auth.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleInitial = $_POST['middle_initial'];
    $rank = $_POST['rank'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['profile_img']['tmp_name'];
        $filename = $_FILES['profile_img']['name'];
        $profile_img = $filename;
        move_uploaded_file($tmp_name, '../uploads/' . $profile_img);
    } else {

        $stmt_select_profile_img = $conn->prepare("SELECT profile_img FROM users WHERE user_ID = ?");
        $stmt_select_profile_img->bind_param("i", $userID);
        $stmt_select_profile_img->execute();
        $stmt_select_profile_img->bind_result($profile_img);
        $stmt_select_profile_img->fetch();
        $stmt_select_profile_img->close();
    }

    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    if (!empty($middle_initial)) {
        $middle_initial = $middle_initial . '.';
    }

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, middle_initial=?, rank=?, designation=?, department=?, email=?, address=?, gender=?, profile_img=? WHERE user_ID = '$userID'");

    $stmt->bind_param("ssssssssss", $firstName, $lastName, $middleInitial, $rank, $designation, $department, $email, $address, $gender, $profile_img);

    if ($stmt->execute()) {
        $success_message = "Profile updated successfully.";
        $userID = $_SESSION['user_id'];
        $userInfo = getUserInfo($conn, $userID);
        $role = $userInfo['role'];
        if ($role === 'admin') {
            header("Location: ../templates/adminPanel/my_profile.php?id={$userID}&success_message={$success_message}");
        } else {
            header("Location: ../templates/userPanel/my_profile.php?id={$userID}&success_message={$success_message}");
        }
        exit();
    } else {
        $error_message = "Error updating profile: " . $stmt->error;
        $userID = $_SESSION['user_id'];
        $userInfo = getUserInfo($conn, $userID);
        $role = $userInfo['role'];
        if ($role === 'admin') {
            header("Location: ../templates/adminPanel/my_profile.php?id={$userID}&error_message={$error_message}");
        } else {
            header("Location: ../templates/userPanel/my_profile.php?id={$userID}&error_message={$error_message}");
        }
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