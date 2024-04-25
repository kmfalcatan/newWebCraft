<?php
include_once "../dbConfig/dbconnect.php";
include_once "../functions/header.php";
include_once "../authentication/auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_ID = $_POST['user_ID'] ?? '';
    $unit_ID = $_POST['unit_ID'] ?? '';
    $equipment_ID = $_POST['equipment_ID'] ?? '';
    $report_issue = $_POST['report_issue'] ?? '';
    $problem_desc = $_POST['problem_desc'] ?? '';
    $yearReceived = $_POST['unit_year'] ?? '';
    
    $unit_img = $_POST['unit_img'] ?? '';
    if (isset($_FILES['unit_img']['name']) && $_FILES['unit_img']['name'] !== '') {
        $unit_img = basename($_FILES['unit_img']['name']); 

        $uploadDir = "../uploads/";
        $uploadFile = $uploadDir . $unit_img;
        
        if (move_uploaded_file($_FILES['unit_img']['tmp_name'], $uploadFile)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }
    }

    $sql = "INSERT INTO approved_report (user_ID, unit_ID, equipment_ID, report_issue, problem_desc, unit_img, unit_year) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isisssi", $user_ID, $unit_ID, $equipment_ID, $report_issue, $problem_desc, $unit_img,  $yearReceived);

        if ($stmt->execute()) {

            // Insert into unit_history
            $stmt_unit_history = $conn->prepare("INSERT INTO unit_history (equipment_ID, unit_ID, report_issue) VALUES (?, ?, ?)");
            $stmt_unit_history->bind_param("iss", $equipment_ID, $unit_ID, $report_issue);
            $stmt_unit_history->execute();
            $stmt_unit_history->close();

            $unit_ID_numeric = intval(substr($unit_ID, strpos($unit_ID, '-') + 1));

            $stmt_get_equipment_id = $conn->prepare("SELECT equipment_ID FROM units WHERE unit_ID = ?");
            $stmt_get_equipment_id->bind_param("i", $unit_ID_numeric);
            $stmt_get_equipment_id->execute();
            $stmt_get_equipment_id->bind_result($equipment_ID);
            $stmt_get_equipment_id->fetch();
            $stmt_get_equipment_id->close();

            $stmt_delete = $conn->prepare("DELETE FROM units WHERE unit_ID = ?");
            $stmt_delete->bind_param("i", $unit_ID_numeric);
            $stmt_delete->execute();

            $stmt_update_total_unit = $conn->prepare("UPDATE equipment SET total_unit = total_unit - 1 WHERE equipment_ID = ?");
            $stmt_update_total_unit->bind_param("i", $equipment_ID);
            $stmt_update_total_unit->execute();

            // Update user_unit
            $sql_count_matches = "SELECT u.equipment_ID, u.user_ID, COUNT(*) as match_count 
                                  FROM units u
                                  INNER JOIN user_unit uu ON u.equipment_ID = uu.equipment_ID AND u.user_ID = uu.user_ID
                                  GROUP BY u.equipment_ID, u.user_ID";
            $result_count_matches = $conn->query($sql_count_matches);

            if ($result_count_matches->num_rows > 0) {
                while ($row = $result_count_matches->fetch_assoc()) {
                    $match_count = $row["match_count"];
                    $sql_update = "UPDATE user_unit SET units_handled = ? WHERE equipment_ID = ? AND user_ID = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("isi", $match_count, $row["equipment_ID"], $row["user_ID"]);
                    $stmt_update->execute();
                    $stmt_update->close();
                }
            } else {
                echo "No matching rows found.";
            }

            header("Location: ../templates/adminPanel/bin.php?id={$userID}&success_message=Unit removed successfully.");
            exit();
        } else {
            echo "Error: " . $stmt->error;

            header("Location: ../templates/adminPanel/bin.php?id={$userID}&error_message=Error removing unit.");
            exit();
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
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