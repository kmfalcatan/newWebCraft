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
                                <li id="inbox">Inbox</li>
                                <li id="outbox">Outbox</li>
                            </ul>
                        </div>

                        <div class="content">
                            <ul id="notification-list" >
                            <?php
                                $unitReportQuery = "SELECT DISTINCT timestamp, report_ID, report_issue, status FROM unit_report WHERE user_ID = '$userID' ORDER BY timestamp DESC";
                                $approvedReportQuery = "SELECT DISTINCT timestamp, approved_ID, report_issue, status FROM approved_report WHERE user_ID = '$userID' ORDER BY timestamp DESC";
                                $unitTransferQuery = "SELECT DISTINCT timestamp, transfer_ID, status FROM unit_transfer WHERE new_end_userID = '$userID' ORDER BY timestamp DESC";

                                $unitReportResult = mysqli_query($conn, $unitReportQuery);
                                $approvedReportResult = mysqli_query($conn, $approvedReportQuery);
                                $unitTransferResult = mysqli_query($conn, $unitTransferQuery);

                                $allReports = array();

                                while ($row = mysqli_fetch_assoc($unitReportResult)) {
                                    $row['type'] = 'unit';
                                    $allReports[] = $row;
                                }

                                while ($row = mysqli_fetch_assoc($approvedReportResult)) {
                                    $row['type'] = 'approved';
                                    $allReports[] = $row;
                                }

                                while ($row = mysqli_fetch_assoc($unitTransferResult)) {
                                    $row['type'] = 'transfer';
                                    $allReports[] = $row;
                                }

                                usort($allReports, function($a, $b) {
                                    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
                                });

                                $userQuery = "SELECT profile_img, first_name, last_name FROM users WHERE user_ID = '$userID'";
                                $userResult = mysqli_query($conn, $userQuery);
                                $userRow = mysqli_fetch_assoc($userResult);
                                $profileImage = $userRow['profile_img'] ? "../../uploads/" . $userRow['profile_img'] : "../../assets/img/pp_placeholder.png";

                                foreach ($allReports as $report) {
                                    $timestamp = strtotime($report['timestamp']);
                                    $timeAgo = time() - $timestamp;

                                    $intervals = array(31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second');
                                    $timeAgoText = '';
                                    foreach ($intervals as $seconds => $unit) {
                                        $interval = floor($timeAgo / $seconds);
                                        if ($interval > 0) {
                                            $timeAgoText = $interval . ' ' . ($interval > 1 ? $unit . 's' : $unit) . ' ago';
                                            break;
                                        }
                                    }

                                    if ($report['type'] === 'unit') {
                                        $reportID = $report['report_ID'];
                                        $status = $report['status'];
                                        $report_issue = $report['report_issue'];

                                        echo "<li class='unit'>
                                                <div class='notification-title'>
                                                    <div class='notif-info'>
                                                        <div class='profile-image'>
                                                            <img src='$profileImage' alt='Profile Image'>
                                                        </div>
                                                        <h3><span class='notif-desc'>$status</span> <span class='notif-time'>$timeAgoText</span></h3>
                                                        <p style='display: none;'>$report_issue</p>
                                                    </div>
                                                    <div class='notification-actions'>";
                                        
                                                    if ($report_issue == 'Lost') {
                                                        echo "<a href='outbox_lost_report.php?id=$userID&report_ID=$reportID'><button class='button4'>View</button></a> ";
                                                    } elseif ($report_issue == 'For return') {
                                                        echo "<a href='outbox_for_return_report.php?id=$userID&report_ID=$reportID'><button class='button4'>View</button></a> ";
                                                    }
        
                                        echo        "<button class='button4' id='red-btn' type='button' onclick='openModal()'>Delete</button>
                                                    </div>
                                                </div>
                                            </li>";

                                        } elseif ($report['type'] === 'approved') {
                                            $approvedID = $report['approved_ID'];
                                            $status = $report['status'];

                                            echo "<li  class='approved'>
                                                    <div class='notification-title'>
                                                        <div class='notif-info'>
                                                            <div class='profile-image'>
                                                                <img src='$profileImage' alt='Profile Image'>
                                                            </div>
                                                            <h3><span class='notif-desc'>$status</span> <span class='notif-time'>$timeAgoText</span></h3>
                                                        </div>
                                                        <div class='notification-actions'>
                                                            <a href='report_approved_notif.php?id=$userID&approved_ID=$approvedID'><button class='button4'>View</button></a> 
                                                            <button class='button4' id='red-btn' type='button' onclick='openModal()'>Delete</button>
                                                        </div>
                                                    </div>
                                                </li>";
                                        } elseif ($report['type'] === 'transfer') {
                                            $transferID = $report['transfer_ID'];
                                            $status = $report['status'];

                                            echo "<li class='transfer'>
                                                    <div class='notification-title'>
                                                        <div class='notif-info'>
                                                            <div class='profile-image'>
                                                                <img src='$profileImage' alt='Profile Image'>
                                                            </div>
                                                            <h3><span class='notif-desc'>$status</span> <span class='notif-time'>$timeAgoText</span></h3>
                                                        </div>
                                                        <div class='notification-actions'>
                                                            <a href='unit_transferred_notif.php?id=$userID&transfer_ID=$transferID'><button class='button4'>View</button></a> 
                                                            <button class='button4' id='red-btn' type='button' onclick='openModal()'>Delete</button>
                                                        </div>
                                                    </div>
                                                </li>";
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

    <div id="sweetalert" class="sweetalert" style="display: none;">
        <div class="alertModal">
            <div class="alertContent">
                <div class="alertIcon">
                    <div class="iconBorder">
                        <img src="../../assets/img/alert.png" alt="">  
                    </div>
                    </div>
                    <div class="alertMsg">
                        <h2 class="confirmationMsg">Are you sure you want to delete this notification?</h2>
                    </div>
                    <div class="alertBtn" id="alertBtn">
                        <button class="button4" type="submit">Yes, I'm sure</button>
                        <button class="button3" id="btn" type="button" onclick="closeModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../../assets/js/userList.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    
    <script>
        const inbox = document.getElementById('inbox');

        inbox.addEventListener('click', function() {
            const items = document.querySelectorAll('#notification-list li');

            items.forEach(item => {
                if (item.classList.contains('approved') || item.classList.contains('transfer')) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        const outbox = document.getElementById('outbox');

        outbox.addEventListener('click', function() {
            const items = document.querySelectorAll('#notification-list li');

            items.forEach(item => {
                if (item.classList.contains('unit')) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        const myNotification = document.querySelector('.menu li');

        myNotification.addEventListener('click', function() {
            const items = document.querySelectorAll('#notification-list li');

            items.forEach(item => {
                item.style.display = 'block';
            });
        });
    </script>

    <script> 
        function openModal() {
            var sweetalert = document.getElementById("sweetalert");
            sweetalert.style.display = "block";
            setTimeout(function() {
                sweetalert.style.opacity = 1;
            }, 10);
        }

        function closeModal() {
            var sweetalert = document.getElementById("sweetalert");
            sweetalert.style.opacity = 0;
            setTimeout(function() {
                sweetalert.style.display = "none";
            }, 300);
        }
    </script>

    
</body>
</html>
