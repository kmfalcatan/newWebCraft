<?php
include_once "../dbConfig/dbconnect.php";

$unitID = $_GET['unitID'];

$sql = "SELECT report_issue, timestamp FROM approved_report WHERE unit_ID = ?";
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
?>