<?php
include_once "../dbConfig/dbconnect.php";
include_once "../authentication/auth.php";
include_once "../functions/header.php";

$user_ID = $_POST['user_ID'];
$unitID = $_POST['unitID'];
$article = $_POST['article'];
$unitYear = $_POST['unitYear'];
$equipmentID = $_POST['equipmentID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

$unitIDNumeric = (int) substr($unitID, strpos($unitID, '-') + 1);

$userFullName = $firstName . ' ' . $lastName;

$query_insert = "INSERT INTO units (user_ID, unit_ID, equipment_name, user, equipment_ID, year_received) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $conn->prepare($query_insert);
$stmt_insert->bind_param("iissii", $user_ID, $unitIDNumeric, $article, $userFullName, $equipmentID, $unitYear);
$result_insert = $stmt_insert->execute();

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
        $stmt_update->bind_param("iii", $match_count, $row["equipment_ID"], $row["user_ID"]);
        $stmt_update->execute();
        $stmt_update->close();
    }
} else {
    echo "No matching rows found.";
}

if ($result_insert) {
    $query_update = "UPDATE equipment SET total_unit = total_unit + 1 WHERE equipment_ID = ?";
    $stmt_update = $conn->prepare($query_update);
    $stmt_update->bind_param("i", $equipmentID);
    $result_update = $stmt_update->execute();

    if ($result_update) {
        $query_delete = "DELETE FROM approved_report WHERE unit_ID = ?";
        $stmt_delete = $conn->prepare($query_delete);
        $stmt_delete->bind_param("s", $unitID);
        $result_delete = $stmt_delete->execute();
        
        if ($result_delete) {
            mysqli_close($conn);
            header("Location: ../templates/adminPanel/unit_list.php?id={$userID}");
            exit();
        } else {
            mysqli_close($conn);
            echo "Failed to delete row from approved_report table: " . $stmt_delete->error;
        }
    } else {
        mysqli_close($conn);
        echo "Failed to update total_unit in equipment table: " . $stmt_update->error;
    }
} else {
    mysqli_close($conn);
    echo "Failed to insert data into units table: " . $stmt_insert->error;
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
