<?php
include_once "../dbConfig/dbconnect.php";
include_once "../functions/header.php";
include_once "../authentication/auth.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT password FROM users WHERE user_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($current_password_hashed);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($old_password, $current_password_hashed)) {
        if ($new_password != $confirm_password) {
            $error_message = "New password and confirm password do not match.";
        } elseif (strlen($new_password) < 6) {
            $error_message = "Password should be at least 6 characters long.";
        } else {
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
          
            $sql = "UPDATE users SET password = ? WHERE user_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_password_hashed, $userID);
            if ($stmt->execute()) {
                $success_message = "Password updated successfully.";
            } else {
                $error_message = "Error updating password: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $error_message = "Old password is incorrect.";
    }
}

$userID = $_SESSION['user_id'];
$userInfo = getUserInfo($conn, $userID);
$role = $userInfo['role'];

if ($role === 'admin') {
    if (isset($success_message)) {
        header("Location: ../templates/adminPanel/my_profile.php?id={$userID}&success_message={$success_message}");
    } elseif (isset($error_message)) {
        header("Location: ../templates/adminPanel/my_profile.php?id={$userID}&error_message={$error_message}");
    } else {
        header("Location: ../templates/adminPanel/my_profile.php?id={$userID}");
    }
} else {
    if (isset($success_message)) {
        header("Location: ../templates/userPanel/my_profile.php?id={$userID}&success_message={$success_message}");
    } elseif (isset($error_message)) {
        header("Location: ../templates/userPanel/my_profile.php?id={$userID}&error_message={$error_message}");
    } else {
        header("Location: ../templates/userPanel/my_profile.php?id={$userID}");
    }
    exit();
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