<?php
include_once "../../dbConfig/dbconnect.php";

$report_ID = $_GET['report_ID'] ?? null;
$timestamp = null;
$user_ID = null;
$unit_reports = [];

if ($report_ID) {
    $query_info = "SELECT timestamp, user_ID FROM unit_report WHERE report_ID = ?";
    $stmt1 = $conn->prepare($query_info);
    $stmt1->bind_param("i", $report_ID);
    $stmt1->execute();
    $result_info = $stmt1->get_result();

    if ($result_info && $result_info->num_rows > 0) {
        $row_info = $result_info->fetch_assoc();
        $timestamp = $row_info['timestamp'];
        $user_ID = $row_info['user_ID'];
        $query_data = "SELECT unit_ID, equipment_ID, user_ID, report_issue, problem_desc, unit_img, timestamp FROM unit_report WHERE timestamp = ?";
        $stmt2 = $conn->prepare($query_data);
        $stmt2->bind_param("s", $timestamp);
        $stmt2->execute();
        $result_data = $stmt2->get_result();

        if ($result_data && $result_data->num_rows > 0) {
            while ($row_data = $result_data->fetch_assoc()) {
                $unit_reports[] = $row_data;
            }
        }
    }
}

$first_name = '';
$last_name = '';
if ($user_ID) {
    $query_user_info = "SELECT first_name, last_name FROM users WHERE user_ID = ?";
    $stmt3 = $conn->prepare($query_user_info);
    $stmt3->bind_param("i", $user_ID);
    $stmt3->execute();
    $result_user_info = $stmt3->get_result();

    if ($result_user_info && $result_user_info->num_rows > 0) {
        $row_user_info = $result_user_info->fetch_assoc();
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
    $query_equipment_info = "SELECT deployment, property_number, account_code, image, article FROM equipment WHERE equipment_ID = ?";
    $stmt4 = $conn->prepare($query_equipment_info);
    $stmt4->bind_param("i", $equipment_ID);
    $stmt4->execute();
    $result_equipment_info = $stmt4->get_result();

    if ($result_equipment_info && $result_equipment_info->num_rows > 0) {
        $row_equipment_info = $result_equipment_info->fetch_assoc();
        $deployment = $row_equipment_info['deployment'];
        $property_number = $row_equipment_info['property_number'];
        $account_code = $row_equipment_info['account_code'];
        $image_url = $row_equipment_info['image'];
        $article = $row_equipment_info['article'];
    }
}

// Get year_received from units table
$year_received = null;
if (!empty($unit_reports)) {
    $unit_ID = $unit_reports[0]['unit_ID'];

    $unitIDNumeric = (int) substr($unit_ID, strpos($unit_ID, '-') + 1);
    
    $query_year_received = "SELECT year_received FROM units WHERE unit_ID = ?";
    $stmt5 = $conn->prepare($query_year_received);
    $stmt5->bind_param("s", $unitIDNumeric);
    $stmt5->execute();
    $result_year_received = $stmt5->get_result();

    if ($result_year_received && $result_year_received->num_rows > 0) {
        $row_year_received = $result_year_received->fetch_assoc();
        $year_received = $row_year_received['year_received'];
    }
}

$formattedTimestamp = date("F j, Y | l g:ia", strtotime($timestamp));
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