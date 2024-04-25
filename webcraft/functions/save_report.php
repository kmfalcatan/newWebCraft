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
    $error_message = ''; // Initialize error message variable

    if ($fileName !== null) {
        $file_size = $_FILES['unit_img']['size'];
        $max_size = 77824;

        if ($file_size > $max_size) {
            $error_message = "Image size exceeds the maximum limit (76.0 KB).";
        } else {
            if (move_uploaded_file($_FILES['unit_img']['tmp_name'], $uploadFile)) {
                $fileUploaded = true;
            } else {
                $error_message = "Sorry, there was an error uploading your file.";
            }
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
            $success_message = "Report submitted successfully.";
        } else {
            $error_message = "Error submitting report: " . $stmt->error;
        }
    }

    if (!empty($error_message)) {
        header("Location: ../templates/userPanel/notification.php?id={$userID}&error_message={$error_message}");
        exit;
    }

    if (!empty($success_message)) {
        header("Location: ../templates/userPanel/notification.php?id={$userID}&success_message={$success_message}");
        exit;
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