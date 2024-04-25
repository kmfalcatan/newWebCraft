<?php
include_once "/xampp/htdocs/webcraft/dbConfig/dbconnect.php";

$userID = isset($_GET['id']) ? $_GET['id'] : null;

function getUserInfo($conn, $userID) {
    $sql = "SELECT * FROM users WHERE user_ID = '$userID'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null; 
    }
}

$userInfo = getUserInfo($conn, $userID);
?>
