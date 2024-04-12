<?php
include_once "../../dbConfig/dbconnect.php";

$report_ID = $_GET['report_ID'] ?? null;
$timestamp = null;
$user_ID = null;
$unit_reports = [];

if ($report_ID) {
    $query_info = "SELECT timestamp, user_ID FROM unit_report WHERE report_ID = '$report_ID'";
    $result_info = mysqli_query($conn, $query_info);

    if ($result_info && mysqli_num_rows($result_info) > 0) {
        $row_info = mysqli_fetch_assoc($result_info);
        $timestamp = $row_info['timestamp'];
        $user_ID = $row_info['user_ID'];
        $query_data = "SELECT unit_ID, equipment_ID, user_ID, report_issue, problem_desc, unit_img, timestamp FROM unit_report WHERE timestamp = '$timestamp'";
        $result_data = mysqli_query($conn, $query_data);
        
        if ($result_data && mysqli_num_rows($result_data) > 0) {
            while ($row_data = mysqli_fetch_assoc($result_data)) {
                $unit_reports[] = $row_data;
            }
        }
    }
}

$first_name = '';
$last_name = '';
if ($user_ID) {
    $query_user_info = "SELECT first_name, last_name FROM users WHERE user_ID = '$user_ID'";
    $result_user_info = mysqli_query($conn, $query_user_info);

    if ($result_user_info && mysqli_num_rows($result_user_info) > 0) {
        $row_user_info = mysqli_fetch_assoc($result_user_info);
        $first_name = $row_user_info['first_name'];
        $last_name = $row_user_info['last_name'];
    }
}

// equipment details
$deployment = '';
$property_number = '';
$account_code = '';
$description = '';
$image_url = '';
$article = '';

foreach ($unit_reports as $report) {
    $equipment_ID = $report['equipment_ID'];
    $query_equipment_info = "SELECT deployment, property_number, account_code, image, article FROM equipment WHERE equipment_ID = '$equipment_ID'";
    $result_equipment_info = mysqli_query($conn, $query_equipment_info);

    if ($result_equipment_info && mysqli_num_rows($result_equipment_info) > 0) {
        $row_equipment_info = mysqli_fetch_assoc($result_equipment_info);
        $deployment = $row_equipment_info['deployment'];
        $property_number = $row_equipment_info['property_number'];
        $account_code = $row_equipment_info['account_code'];
        $image_url = $row_equipment_info['image'];
        $article = $row_equipment_info['article'];
    }
}

$formattedTimestamp = date("F j, Y | l g:ia", strtotime($timestamp));
?>