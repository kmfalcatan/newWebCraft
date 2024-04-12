<?php
    include_once "../../dbConfig/dbconnect.php";
    include_once "../../authentication/auth.php";
    include_once "../../functions/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/notification.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebarContent">
            <div class="arrowContainer" style="margin-left: 80rem;" id="toggleButton">
                <div class="subArrowContainer">
                    <img class="hideIcon" src="../../assets/img/chevron-left (1).png" alt="">
                </div>
            </div>
        </div>
        <?php include("sidebar.php"); ?>
    </div>

    <div class="mainContainer">
        <div class="sideBarContainer3">
            <div class="headerContainer1">
                <div class="iconContainer10">
                    <a href="#">
                    <div class="subIconContainer10">
                        <img class="subIconContainer10" src="../../assets/img/notif.png" alt="">
                    </div>
                    </a>
                </div>

                <div class="subHeaderContainer1">
                    <div class="logoNameContainer1">
                        <img class="systemName" src="../../assets/img/system-name.png" alt="">
                    </div>
                    <div class="subImageContainer3">
                        <img class="image11" src="../../assets/img/medLogo.png" alt="">
                    </div>
                </div>
            </div>

            <div class="subContainer1">
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>NOTIFICATION</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>
                    </div>
                </div>

                <div class="userListContainer" >
                    <div class="notifContainer">
                        <div class="notif-sidebar">
                            <h2>Menu</h2>
                            <ul class="menu">
                                <li>My Notification</li>
                                <li>Filter</li>
                            </ul>
                        </div>

                        <div class="content">
                            <ul id="notification-list" >
                                <?php
                                    $unitReportQuery = "SELECT DISTINCT timestamp, user_ID, report_ID, report_issue, status FROM unit_report ORDER BY timestamp DESC";
                                    $unitReplacementQuery = "SELECT DISTINCT timestamp, user_ID, replacement_ID, status FROM unit_replacement ORDER BY timestamp DESC";

                                    $unitReportResult = mysqli_query($conn, $unitReportQuery);
                                    $unitReplacementResult = mysqli_query($conn, $unitReplacementQuery);

                                    $allReports = array();

                                    while ($row = mysqli_fetch_assoc($unitReportResult)) {
                                        $row['type'] = 'unit';
                                        $allReports[] = $row;
                                    }

                                    while ($row = mysqli_fetch_assoc($unitReplacementResult)) {
                                        $row['type'] = 'replacement';
                                        $allReports[] = $row;
                                    }

                                    usort($allReports, function($a, $b) {
                                        return strtotime($b['timestamp']) - strtotime($a['timestamp']);
                                    });

                                    foreach ($allReports as $report) {
                                        $timestamp = strtotime($report['timestamp']);
                                        $status = $report['status'];
                                        $user_ID = $report['user_ID'];
                                        $type = $report['type'];

                                        $report_issue = isset($report['report_issue']) ? $report['report_issue'] : '';

                                        $userQuery = "SELECT profile_img, first_name, last_name FROM users WHERE user_ID = '$user_ID'";
                                        $userResult = mysqli_query($conn, $userQuery);

                                        if ($userRow = mysqli_fetch_assoc($userResult)) {
                                            $image = $userRow['profile_img'];
                                            $firstName = $userRow['first_name'];
                                            $lastName = $userRow['last_name'];

                                            $timeDiff = time() - $timestamp;

                                            $intervals = array(
                                                31536000 => 'year',
                                                2592000 => 'month',
                                                604800 => 'week',
                                                86400 => 'day',
                                                3600 => 'hour',
                                                60 => 'minute',
                                                1 => 'second'
                                            );

                                            $timeAgo = '';

                                            foreach ($intervals as $seconds => $unit) {
                                                $interval = floor($timeDiff / $seconds);

                                                if ($interval > 0) {
                                                    $timeAgo .= $interval . ' ' . ($interval > 1 ? $unit . 's' : $unit) . ' ago';
                                                    break;
                                                }
                                            }

                                            $profileImage = $image ? "../../uploads/" . $image : "../../assets/img/pp_placeholder.png";

                                            if ($type === 'unit') {
                                                $reportID = $report['report_ID'];

                                                // unit report
                                                echo "<li>";
                                                echo "<div class='notification-title'>";
                                                echo "<div class='notif-info'>";
                                                echo "<div class='profile-image'>";
                                                echo "<img src='$profileImage' alt='Profile Image'>";
                                                echo "</div>";
                                                echo "<h3>$firstName $lastName<span class='notif-desc'>Sent you a report</span> <span class='notif-time'>$timeAgo</span></h3>";
                                                echo "<p style='display: none;'>$report_issue</p>";
                                                echo "</div>";
                                                echo "<div class='notification-actions'>";
                                                if ($report_issue == 'Lost') {
                                                    echo "<a href='lost_report.php?id=$userID&report_ID=$reportID'><button class='button4'>View</button></a> ";
                                                } elseif ($report_issue == 'For return') {
                                                    echo "<a href='for_return_report.php?id=$userID&report_ID=$reportID'><button class='button4'>View</button></a> ";
                                                }
                                            
                                                echo "<button class='button4' id='red-btn'>Delete</button>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</li>";
                                            } elseif ($type === 'replacement') {
                                                $replacementID = $report['replacement_ID'];

                                                // replacement report
                                                echo "<li>";
                                                echo "<div class='notification-title'>";
                                                echo "<div class='notif-info'>";
                                                echo "<div class='profile-image'>";
                                                echo "<img src='$profileImage' alt='Profile Image'>";
                                                echo "</div>";
                                                echo "<h3>$firstName $lastName<span class='notif-desc'>$status</span> <span class='notif-time'>$timeAgo</span></h3>";
                                                echo "</div>";
                                                echo "<div class='notification-actions'>";
                                                echo "<a href='unit_replacement.php?id=$userID&replacement_ID=$replacementID'><button class='button4' onclick='toggleFontWeight()'>View</button></a> ";
                                                echo "<button class='button4' id='red-btn'>Delete</button>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</li>";
                                            }
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/password_checker.js"></script>
    <script src="../../assets/js/userList.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

</body>
</html>
