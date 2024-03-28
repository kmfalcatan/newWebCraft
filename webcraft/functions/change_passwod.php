<?php
include_once "../dbConfig/dbconnect.php";
include_once "../functions/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmSave'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT password FROM users WHERE user_ID = '$userID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_password_hashed = $row['password'];

    if (password_verify($old_password, $current_password_hashed)) {
        if ($new_password != $confirm_password) {
            $error_message = "New password and confirm password do not match.";
        } elseif (strlen($new_password) < 6) {
            $error_message = "Password should be at least 6 characters long.";
        } else {
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
          
            $sql = "UPDATE users SET password = '$new_password_hashed' WHERE user_ID = '$userID'";
            if (mysqli_query($conn, $sql)) {
                $success_message = "Password updated successfully.";
            } else {
                $error_message = "Error updating password: " . mysqli_error($conn);
            }
        }
    } else {
        $error_message = "Old password is incorrect.";
    }
}
?>