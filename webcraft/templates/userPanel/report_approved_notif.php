<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";
include_once "../../functions/header.php";

$approvedID = isset($_GET['approved_ID']) ? $_GET['approved_ID'] : null;

if ($approvedID) {
    
    $sql = "SELECT user_ID, equipment_ID, unit_ID, report_issue, problem_desc, timestamp FROM approved_report WHERE approved_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $approvedID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $user_ID = $row['user_ID'];
        $equipmentID = $row['equipment_ID'];
        $unitID = $row['unit_ID'];
        $reportIssue = $row['report_issue'];
        $problemDesc = $row['problem_desc'];
        $timestamp = $row['timestamp'];

        $formattedTimestamp = date("F j, Y | l g:ia", strtotime($timestamp));

        $sql = "SELECT article, property_number, account_code FROM equipment WHERE equipment_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $equipmentID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $article = $row['article'];
            $propertyNumber = $row['property_number'];
            $accountCode = $row['account_code'];
        } else {
            $error_message = "Error: No equipment found with the given ID";
        }

        $stmt->close();
    } else {
        $error_message = "Error: No transfer found with the given ID";
    }
} else {
    $error_message = "Error: No transfer ID provided";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/equip_details.css">
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

    <div class="mainContainer" >
        <div class="sideBarContainer3">
            <div class="headerContainer1">
                <div class="iconContainer10">
                    <a href="notification.php?id=<?php echo urlencode($userID); ?>">
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
            
            <div class="subContainer1" id="containerToReplace" >
                <div class="equipContainer">
                    <div class="filterContainer1" style="width: 100%; margin-top: 0rem;">
                        <div class="inventoryNameContainer">
                            <p>APPROVED REPORT</p>
                        </div>

                        <div class="subFilterContainer1">
                            <!-- <div class="trackContainer">
                                <a href="notification.php?id=<?php echo urlencode($userID); ?>">
                                    <button class="trackButton1" style="width: auto; padding: 0 1.5rem;">Back</button>
                                </a>
                            </div> -->
                        </div>
                    </div>

                    <div class="subViewApproveContainer">

                    <div class="container">
                        <div class="check">
                            <p>&#10004;</p>
                        </div>
                        <div class="message">Your report for <?php echo $unitID; ?> has been approved.</div>
                        <div class="paragraph">
                            This unit has been removed from the available unit list. It will be restored once this unit is found, replaced, or fixed.
                        </div>
                        <div class="report-info">
                            <p>Article: <span><?php echo $article; ?></span></p>
                            <p>Property number: <span><?php echo $propertyNumber; ?></span></p>
                            <p>Account code: <span><?php echo $accountCode; ?></span></p>
                            <br>
                            <hr>
                            <br>
                            <h3>REPORTED UNIT</h3>
                            <br>
                            <p>Unit ID: <span><?php echo $unitID; ?></span></p>
                            <P>Unit issue: <span><?php echo $reportIssue; ?></span></P>
                            <p>Problem description: <span><?php echo $problemDesc; ?></span></p>
                            <br>
                            <br>
                            <p>Date approved: <span class="approvedDate"><?php echo $formattedTimestamp; ?></span></p>
                        </div>

                        <button class="button" onclick="toggleReportInfo()">See Report</button>
                        <br>
                        <a href="notification.php?id=<?php echo urlencode($userID); ?>">
                            <button class="button3" type="button" style="border-radius: 0.3rem;">Close</button>
                        </a>
                    </div>

                </div>
            </div>
    
    </div>
</div>
 <script src="../../assets/js/sidebar.js"></script>

 <script>
  function toggleReportInfo() {
    var reportInfo = document.querySelector('.report-info');
    var button = document.querySelector('.button');

    if (reportInfo.style.display === 'none') {
      reportInfo.style.display = 'block';
      button.textContent = 'Hide';
    } else {
      reportInfo.style.display = 'none';
      button.textContent = 'See Report';
    }
  }
</script>

</body>
</html>

<!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
    *Administartive Office Facility Reservation and Management System*
    *IT 132 - Software Engineering *
    *(WebCraft) Members:
        Falcatan, Khriz Marr
        Gabotero, Rogie
        Taborada, John Mark
        Tingkasan, Padwa 
        Villares, Arp-J* -->