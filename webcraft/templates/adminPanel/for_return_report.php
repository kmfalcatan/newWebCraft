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
                        <p>NOTIFICATION</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="notification.php?id=<?php echo $userID ?>">
                                <button class="trackButton1">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                    <form class="subViewApproveContainer" action="../../functions/approve_report.php" enctype="multipart/form-data" method="post">
                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage" >
                                    <?php if (!empty($image_url)): ?>
                                        <img class="equipImage2" src="../../uploads/<?php echo $image_url; ?>" alt="">
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
                        
                        <div class="unitSelected" >
                            <p>UNIT REPORTED</p>
                        </div>

                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage3">
                                    <?php if (!empty($report['unit_img'])): ?>
                                        <img class="equipImage2" src="../../uploads/<?php echo $report['unit_img']; ?>" alt="">
                                    <?php else: ?>
                                        <img class="equipImage2" src="../../assets/img/img_placeholder.jpg" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <input type="hidden" name="unit_img" value="<?php echo $report['unit_img']; ?>">

                            <div class="approveInfoContainer">
                                
                                <div class="subApproveInfoContainer1">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit ID</p>
                                        </div>

                                        <input class="container4" type="text" name="unit_ID" value="<?php echo $report['unit_ID']; ?>" readonly>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit issue</p>
                                        </div>

                                        <input class="container4" type="text" name="report_issue" value="<?php echo $report['report_issue']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer" id="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Problem description</p>
                                        </div>

                                        <input class="container4" type="text" name="problem_desc" value="<?php echo $report['problem_desc']; ?>" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <div class="buttonContainer2" id="buttonContainer2" style="width: 86%;">
                            <p><?php echo $formattedTimestamp ?></p>
                            <button class="button4" id="confirm-submit" type="button" onclick="openModal()">Approve</button>
                            <a href="my_units.php?id=<?php echo $userID; ?>">
                                <button class="button3"  id="red-btn" type="button">Decline</button>
                            </a>
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
                                        <h2>Are you sure you want to approve report?</h2>
                                    </div>
                                    <div class="alertBtn" id="alertBtn">
                                        <button class="button4" type="submit">Yes, I'm sure</button>
                                        <button class="button3" id="btn" type="button" onclick="closeModal()">Cancel</button>
                                    </div>
                                </div>
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