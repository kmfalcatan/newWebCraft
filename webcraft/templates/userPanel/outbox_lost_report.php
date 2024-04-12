<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include_once "../../functions/report_details.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY POFILE</title>

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
                        <p>UNIT REPORTED</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="notification.php?id=<?php echo $userID ?>">
                                <button class="trackButton1">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                    <div class="subViewApproveContainer" >
                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage" >
                                    <?php if (!empty($image_url)): ?>
                                        <img class="equipImage2" src="../../uploads/<?php echo $image_url; ?>" alt="">
                                    <?php else: ?>
                                        <img class="equipImage2" src="../../assets/img/img_placeholder.jpg" alt="">
                                    <?php endif; ?>
                                </div>

                                <div class="equipNameContainer" id="article">
                                    <p><?php echo $article; ?></p>
                                </div>
                            </div>

                            <div class="approveInfoContainer">
                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>End user</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $first_name; ?> <?php echo $last_name; ?>" readonly>
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

                                        <input class="container4" type="text" value="<?php echo $property_number; ?>" readonly>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Account code</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $account_code; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="unitSelected">
                            <p>UNIT REPORTED</p>
                        </div>

                        <div class="viewInfoContainer" id="viewInfoContainer1">

                            <div class="approveInfoContainer">
                                
                                <div class="subApproveInfoContainer1"  style=" width: 60%; gap: 1.5rem;">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit ID  <span style="color: red; font-size: 1.3rem;">*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="unit_ID" value="<?php echo $report['unit_ID']; ?>" readonly>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit issue <span style="color: red; font-size: 1.3rem;">*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="report_issue" value="<?php echo $report['report_issue']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1" id="subApproveInfoContainer">

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Problem Description <span style="color: red; font-size: 1.3rem;">*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="problem_desc" value="<?php echo $report['problem_desc']; ?>" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                       
                        <div class="buttonContainer2" id="buttonContainer2" style="width: 86%;">
                            <p><span style="font-size: 1.1rem; margin-right: 1rem">Sent:  </span><?php echo $formattedTimestamp ?></p>
                            <!-- <button class="button4" type="button" onclick="openModal()">Submit</button> -->
                        </div>

                        </div>
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