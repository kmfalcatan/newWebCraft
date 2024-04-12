<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include_once "../../functions/report_details.php";

    $approved_ID = $_GET['approved_ID'];

    $query = "SELECT ar.approved_ID, ar.unit_ID, ar.report_issue, ar.problem_desc, ar.unit_img, ar.user_ID, ar.timestamp, e.article, e.deployment, e.property_number, e.account_code, e.image, u.first_name, u.middle_initial, u.last_name
            FROM approved_report ar
            INNER JOIN equipment e ON ar.equipment_ID = e.equipment_ID
            INNER JOIN users u ON ar.user_ID = u.user_ID
            WHERE approved_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $approved_ID);
    $stmt->execute();
    $stmt->bind_result($approvedID, $unitID, $reportIssue, $problemDesc, $unitImg, $user_ID, $timestamp, $article, $deployment, $propertyNumber, $accountCode, $image, $firstName, $middleIntial, $lastName);
    $stmt->fetch();
    if ($timestamp !== null) {
        $timestamp = strtotime($timestamp);

        $formattedTimestamp = date("F j, Y | l g:ia", $timestamp);
    } else {
        $formattedTimestamp = "Invalid timestamp";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIT REPORTED</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/equip_details.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
</head>
<style>
    .container4{
        width: 95%;
    }
    
</style>
<body>
    <div class="sidebar">
        <div  class="sidebarContent">
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
                    <a href="notification.php?id=<?php echo $userID; ?>">
                    <div class="subIconContainer10">
                        <img class="subIconContainer10" src="../../assets/img/notif.png" alt="">
                    </div>
                    </a>
                </div>

                <div class="subHeaderContainer1" >
                    <div class="logoNameContainer1">
                        <img class="systemName" src="../../assets/img/system-name.png" alt="">
                    </div>
                    <div class="subImageContainer3">
                        <img class="image11" src="../../assets/img/medLogo.png" alt="">
                    </div>
                </div>
            </div>

            <div class="subContainer1" id="containerToReplace">
                <div class="equipContainer">
                <div class="filterContainer1" style="width: 100%; margin-top: 0rem;">
                    <div class="inventoryNameContainer">
                        <p>UNIT DETAILS</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="unit_replacement.php?id=<?php echo $userID; ?>&approved_ID=<?php echo $approvedID; ?>">
                                <button class="trackButton" style="padding: 0 1.5rem;">Replacement<span style="margin-left: 0.4rem;">form</span></button>
                            </a>
                            <a href="bin.php?id=<?php echo $userID; ?>">
                                <button class="trackButton" style="padding: 0 1.5rem;">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                    <form class="subViewApproveContainer" action="../../functions/approve_report.php" enctype="multipart/form-data" method="post">
                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage" >
                                    <?php if (!empty($image)): ?>
                                        <img class="equipImage2" src="../../uploads/<?php echo $image; ?>" alt="">
                                    <?php else: ?>
                                        <img class="equipImage2" src="../../assets/img/img_placeholder.jpg" alt="">
                                    <?php endif; ?>
                                </div>

                                <div class="equipNameContainer" id="article" s>
                                    <p><?php echo $article; ?></p>
                                    <input type="hidden" name="equipment_ID" value="<?php echo $report['equipment_ID']; ?>">
                                    <input type="hidden" name="user_ID" value="<?php echo $report['user_ID']; ?>">
                                </div>
                            </div>

                            <div class="approveInfoContainer">
                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>End user</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $firstName; ?>  <?php echo $middleIntial; ?> <?php echo $lastName; ?>" readonly>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Deployment</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $deployment; ?>" readonly>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Property number</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $propertyNumber; ?>" readonly>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Account code</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $accountCode; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="unitSelected" >
                            <p>UNIT REPORTED</p>
                        </div>

                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage3">
                                    <?php if (!empty($unitImg)): ?>
                                        <img class="equipImage2" src="../../uploads/<?php echo $unitImg; ?>" alt="">
                                    <?php else: ?>
                                        <img class="equipImage2" src="../../assets/img/img_placeholder.jpg" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="approveInfoContainer">
                                
                                <div class="subApproveInfoContainer1">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit ID</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $unitID; ?>" readonly>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit issue</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $reportIssue; ?>" readonly>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer" id="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Problem description</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $problemDesc; ?>" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="buttonContainer2" id="buttonContainer2" style="width: 86%;">
                            <p>Approved on: <?php echo $formattedTimestamp ?></p>
                            <!-- <button class="button4" id="confirm-submit" type="button" onclick="openModal()">Restore</button>
                            <a href="bin.php?id=<?php echo $userID?>">
                                <button class="button3" type="button" >Cancel</button>
                            </a> -->
                        </div>
                       
                        </div>
                    </form>
                </div>
            
            </div>  
        </div>
    </div>
</div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/uploadImg.js"></script>

</body>
</html>