<?php
include_once "../dbConfig/dbconnect.php";
include_once "../authentication/auth.php";

$user_ID = $_POST['user_ID'];
$unitID = $_POST['unitID'];
$article = $_POST['article'];
$equipmentID = $_POST['equipmentID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

$unitIDNumeric = (int) substr($unitID, strpos($unitID, '-') + 1);

$userFullName = $firstName . ' ' . $lastName;

$query_insert = "INSERT INTO units (user_ID, unit_ID, equipment_name, user, equipment_ID) VALUES ('$user_ID', '$unitIDNumeric', '$article', '$userFullName', '$equipmentID')";
$result_insert = mysqli_query($conn, $query_insert);

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

if ($result_insert) {
    $query_update = "UPDATE equipment SET total_unit = total_unit + 1 WHERE equipment_ID = '$equipmentID'";
    $result_update = mysqli_query($conn, $query_update);

    if ($result_update) {
        /*
        $query_delete = "DELETE FROM approved_report WHERE unit_ID = '$unitID'";
        $result_delete = mysqli_query($conn, $query_delete);

        if ($result_delete) {
            mysqli_close($conn);
            header("Location: unit_list.php?id={$userID}");
            exit();
        } else {
            mysqli_close($conn);
            echo "Failed to delete row from approved_report table: " . mysqli_error($conn);
        }
        */
        
        mysqli_close($conn);
        header("Location: unit_list.php?id={$userID}");
        exit();
    } else {
        mysqli_close($conn);
        $_SESSION['error_message'] = "Failed to update total_unit in equipment table: " . mysqli_error($conn);
        header("Location: restore_unit.php");
        exit(); 
    }
} else {
    mysqli_close($conn);
    $_SESSION['error_message'] = "Failed to insert data into units table: " . mysqli_error($conn);
    header("Location: restore_unit.php");
    exit(); 
}
?>