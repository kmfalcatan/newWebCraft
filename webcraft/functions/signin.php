<?php
session_start();

require_once '../dbConfig/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = loginUser($username, $password);

        if ($result === true) {
            $user = getUserByusername($username);
            $_SESSION['user_id'] = $user['user_ID'];
            if ($user['role'] === 'admin') {
                header("Location: ../templates/adminPanel/loading.php?id=" . urlencode($user['user_ID']));
            } else {
                header("Location: ../templates/userPanel/loading.php?id=" . urlencode($user['user_ID']));

            }
            exit();
        } else {
            $_SESSION['login_error'] = $result;
            header('Location: signin.php');
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Please fill in all required fields.";
        header('Location: signin.php');
        exit();
    }
}

function loginUser($username, $password)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return "Invalid username or password.";
    }

    $user = $result->fetch_assoc();
    $hashedPassword = $user['password'];

    if (password_verify($password, $hashedPassword)) {
        return true;
    } else {
        return "Invalid username or password.";
    }
}

function getUserByusername($username)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return null;
    }

    return $result->fetch_assoc();
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