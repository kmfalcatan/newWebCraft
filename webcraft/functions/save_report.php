<?php
include_once "../dbConfig/dbconnect.php";
include_once "../functions/header.php";
include_once "../authentication/auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $equipmentID = $_POST['equipment_ID'] ?? '';
    $userID = $_POST['user_ID'] ?? '';
    $unitID = $_POST['unit_ID'] ?? '';
    $reportIssue = $_POST['report_issue'] ?? '';
    $problemDesc = $_POST['problem_desc'] ?? '';
    $fileName = isset($_FILES['unit_img']['name']) && !empty($_FILES['unit_img']['name']) ? basename($_FILES['unit_img']['name']) : null; // Modified

    $uploadDir = "../uploads/";
    $uploadFile = $uploadDir . $fileName;

    $fileUploaded = false;
    if ($fileName !== null) {
        if (move_uploaded_file($_FILES['unit_img']['tmp_name'], $uploadFile)) {
            $fileUploaded = true;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $fileUploaded = true;
    }

    if ($fileUploaded) {
        $query = "INSERT INTO unit_report (equipment_ID, user_ID, unit_ID, report_issue, problem_desc, unit_img) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if (!$fileName) {
            $stmt->bind_param("iissss", $equipmentID, $userID, $unitID, $reportIssue, $problemDesc, $fileName);
            $fileName = null;
        } else {
            $stmt->bind_param("iissss", $equipmentID, $userID, $unitID, $reportIssue, $problemDesc, $fileName);
        }

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../templates/userPanel/notification.php?id={$userID}");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
