<?php
include_once "../dbConfig/dbconnect.php";
include_once "../functions/header.php";
include_once "../authentication/auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $equipmentID = $_POST["equipment_ID"];
    $unitID = $_POST["unit_ID"];
    $new_end_userID = $_POST["new_end_userID"];
    $old_end_userID = $_POST["old_end_userID"];
    $old_end_user_first_name = $_POST["old_end_user_first_name"];
    $old_end_user_last_name = $_POST["old_end_user_last_name"];
    $new_end_user_first_name = $_POST["new_end_user_first_name"];
    $new_end_user_last_name = $_POST["new_end_user_last_name"];

    $unitID_numeric = intval(substr($unitID, strpos($unitID, '-') + 1));
    
    // Get the current value of year_received from units table
    $stmt = $conn->prepare("SELECT year_received FROM units WHERE unit_ID = ?");
    $stmt->bind_param("i", $unitID_numeric);
    $stmt->execute();
    $stmt->bind_result($year_received);
    $stmt->fetch();
    $stmt->close();

    // Insert into unit_transfer table
    $sql = "INSERT INTO unit_transfer (unit_ID, equipment_ID, old_end_userID, new_end_userID, old_end_user_first_name, old_end_user_last_name, new_end_user_first_name, new_end_user_last_name, year_transfer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisssssi", $unitID, $equipmentID, $old_end_userID, $new_end_userID, $old_end_user_first_name, $old_end_user_last_name, $new_end_user_first_name, $new_end_user_last_name, $year_received);
    
    if ($stmt->execute()) {
        $success_message = "Unit transferred successfully.";

        $current_year = date("Y");

        // Update units table
        $user = $new_end_user_first_name . ' ' . $new_end_user_last_name;
        $sql = "UPDATE units SET user = ?, user_ID = ?, year_received = ? WHERE unit_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $user, $new_end_userID, $current_year, $unitID_numeric);
        
        if ($stmt->execute()) {
            $stmt->close();

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
                $error_message = "No matching rows found.";
            }
            
            header("Location: ../templates/adminPanel/unit_list.php?id={$userID}&success_message={$success_message}");
            exit;
        } else {
            $error_message = "Error updating units table: " . $stmt->error;
        }
    } else {
        $error_message = "Error unit transfer: " . $stmt->error;
    }

    header("Location: ../templates/adminPanel/unit_list.php?id={$userID}&error_message={$error_message}");
    exit;
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