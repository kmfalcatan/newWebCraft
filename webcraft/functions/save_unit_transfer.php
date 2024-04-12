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

    // Insert into unit_transfer table
    $sql = "INSERT INTO unit_transfer (unit_ID, equipment_ID, old_end_userID, new_end_userID, old_end_user_first_name, old_end_user_last_name, new_end_user_first_name, new_end_user_last_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisssss", $unitID, $equipmentID, $old_end_userID, $new_end_userID, $old_end_user_first_name, $old_end_user_last_name, $new_end_user_first_name, $new_end_user_last_name);
    
    if ($stmt->execute()) {
        echo "Unit transfer saved successfully.";

        $unitID_numeric = intval(substr($unitID, strpos($unitID, '-') + 1));

        // Update units table
        $user = $new_end_user_first_name . ' ' . $new_end_user_last_name;
        $sql = "UPDATE units SET user = ?, user_ID = ? WHERE unit_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $user, $new_end_userID, $unitID_numeric);
        
        if ($stmt->execute()) {
            $stmt->close();

            // upate user_unit
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
            
            header("Location: ../templates/adminPanel/unit_list.php?id={$userID}");
            exit;
        } else {
            echo "Error updating units table: " . $stmt->error;
        }
    } else {
        echo "Error saving unit transfer: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
