<?php
include_once "../dbConfig/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_ID = $_POST['user_ID'] ?? '';
    $unit_ID = $_POST['unit_ID'] ?? '';
    $equipment_ID = $_POST['equipment_ID'] ?? '';
    $report_issue = $_POST['report_issue'] ?? '';
    $problem_desc = $_POST['problem_desc'] ?? '';
    
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

    $sql = "INSERT INTO approved_report (user_ID, unit_ID, equipment_ID, report_issue, problem_desc, unit_img) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isisss", $user_ID, $unit_ID, $equipment_ID, $report_issue, $problem_desc, $unit_img);

        if ($stmt->execute()) {

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


            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit(); 
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
