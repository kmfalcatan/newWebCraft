<?php
require_once '../dbConfig/dbconnect.php';
require_once '../functions/header.php';
require_once '../authentication/auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unitIDs = explode("\n", $_POST['unit_ID']);
    $reportIssues = explode("\n", $_POST['report_issue']);
    $problemDescs = explode("\n", $_POST['problem_desc']);

    $equipment_ID = $_POST['equipment_ID'];
    $user_ID = $_POST['user_ID'];
    $user = $_POST['user'];

    $timestamp = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO unit_report (timestamp, equipment_ID, user_ID, unit_handler, unit_ID, report_issue, problem_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

    for ($i = 0; $i < count($unitIDs); $i++) {
        if (!empty($unitIDs[$i]) && !empty($reportIssues[$i]) && !empty($problemDescs[$i])) {
            $stmt->bind_param("siiisss", $timestamp, $equipment_ID, $user_ID, $user, $unitIDs[$i], $reportIssues[$i], $problemDescs[$i]);
            $stmt->execute();
        }
    }
    $stmt->close();
}

$userID = $_SESSION['user_id']; 
$userInfo = getUserInfo($conn, $userID);
$role = $userInfo['role'];

if ($role === 'user') {
    header("Location: ../user panel/reportSent.php?id={$userID}");
    exit();
} else {
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
