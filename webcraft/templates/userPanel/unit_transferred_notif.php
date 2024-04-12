<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";
include_once "../../functions/header.php";

$transferID = isset($_GET['transfer_ID']) ? $_GET['transfer_ID'] : null;

if ($transferID) {
    
    $sql = "SELECT equipment_ID, unit_ID, old_end_userID, old_end_user_first_name, old_end_user_last_name, timestamp FROM unit_transfer WHERE transfer_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transferID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $equipmentID = $row['equipment_ID'];
        $unitID = $row['unit_ID'];
        $oldEndUserID = $row['old_end_userID'];
        $oldEndUserFirstName = $row['old_end_user_first_name'];
        $oldEndUserLastName = $row['old_end_user_last_name'];
        $timestamp = $row['timestamp'];

        $sql = "SELECT middle_initial, designation, email, username FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $oldEndUserID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $middleInitial = $row['middle_initial'];
            $designation = $row['designation'];
            $email = $row['email'];
            $username = $row['username'];
        } else {
            $error_message = "Error: No user found with the given ID";
        }

        $sql = "SELECT article, account_code, property_number FROM equipment WHERE equipment_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $equipmentID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $article = $row['article'];
            $accountCode = $row['account_code'];
            $propertyNumber = $row['property_number'];

            $formattedTimestamp = date("F j, Y | l g:ia", strtotime($timestamp));
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
    <title>NOTIFICATION</title>

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
            
            <div class="subContainer1" id="containerToReplace" >
                <div class="equipContainer">
                    <div class="filterContainer1" style="width: 100%; margin-top: 0rem;">
                        <div class="inventoryNameContainer">
                            <p>APPROVED REPORT</p>
                        </div>

                        <div class="subFilterContainer1">
                            <div class="trackContainer">
                                <a href="notification.php?id=<?php echo $userID ?>">
                                    <button class="trackButton1">Back</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="subViewApproveContainer">

                    <div class="container">
                        <div class="received">
                            <img src="../../assets/img/received_icon.png" alt="">
                        </div>
                        <div class="message">You have a new unit transferred to your account.</div>
                        <div class="paragraph">
                            This unit has been transferred to you, and you are now the new end user of the unit. As the new end user you are now responsible for managing this unit. Please see more for unit details.
                        </div>
                        <div class="report-info">
                            <p>Unit ID: <span><?php echo $unitID; ?></span></p>
                            <p>Article: <span><?php echo $article; ?></span></p>
                            <p>Property number: <span><?php echo $propertyNumber; ?></span></p>
                            <p>Account code: <span><?php echo $accountCode; ?></span></p>
                            <br>
                            <hr>
                            <br>
                            <h3>OLD END USER</h3>
                            <br>
                            <P>First name: <span><?php echo $oldEndUserFirstName; ?></span></P>
                            <p>Last name: <span><?php echo $oldEndUserLastName; ?></span></p>
                            <p>E-mail: <span><?php echo $email; ?></span></p>
                            <p>Username: <span><?php echo $username; ?></span></p>
                            <p>Designation: <span><?php echo $designation; ?></span></p>
                            <br>
                            <br>
                            <p>Date trasnfer: <span class="approvedDate"><?php echo $formattedTimestamp; ?></span></p>
                        </div>

                        <button class="button" onclick="toggleReportInfo()">See More</button>
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
      button.textContent = 'See More';
    }
  }
</script>

</body>
</html>