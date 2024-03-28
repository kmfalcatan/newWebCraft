<?php
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../landing_page.php");
    exit(); 
}

$userID = $_SESSION['user_id'];
?>