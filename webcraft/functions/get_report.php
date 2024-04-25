<?php
include_once "../dbConfig/dbconnect.php";

$unitID = $_GET['unitID'];

$sql = "SELECT unit_ID FROM unit_history";
$result = $conn->query($sql);

$unitIDs = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unitIDs[] = $row['unit_ID'];
    }
}

if (in_array($unitID, $unitIDs)) {
    $sql = "SELECT report_issue, timestamp FROM unit_history WHERE unit_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $unitID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $response = array(
            'report_issue' => $row['report_issue'],
            'timestamp' => $row['timestamp']
        );
        echo json_encode($response);
    } else {
        echo json_encode(array()); 
    }
} else {
    echo json_encode(array()); 
}
?>