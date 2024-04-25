<?php
    include_once "../../functions/header.php";
    include_once "../../dbConfig/dbconnect.php";
    include_once "../../authentication/auth.php";

    $userID = $_GET['id'];

    $unitID = $_GET['unitID'] ?? '';
    $reportReason = $_GET['reportReason'] ?? '';
    $formattedUnitID = 'UNIT-' . str_pad($unitID, 4, '0', STR_PAD_LEFT);

    $sql = "SELECT user_ID, equipment_name, user, year_received FROM units WHERE unit_ID = ?";
    $stmt1 = $conn->prepare($sql);
    $stmt1->bind_param("i", $unitID);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($user_ID, $equipmentName, $user, $yearReceived);
    $stmt1->fetch();

    $sql = "SELECT equipment_ID, deployment, property_number, account_code, image FROM equipment WHERE article = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("s", $equipmentName);
    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($equipmentID, $deployment, $propertyNumber, $accountCode, $image);
    $stmt2->fetch();
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
                        <p>REMOVE UNIT</p>
                    </div>

                    <div class="subFilterContainer1">
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
                                    <p><?php echo $equipmentName; ?></p>
                                    <input type="hidden" name="equipment_ID" id="" value="<?php echo $equipmentID; ?>">
                                </div>
                            </div>

                            <div class="approveInfoContainer">
                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>End user</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $user; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                        <input class="hidden" type="text" name="user_ID" value="<?php echo $user_ID; ?>">
                                        <input type="hidden" value="<?php echo $userID; ?>">
                                        <input type="hidden" name="unit_year" value="<?php echo $yearReceived; ?>">
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Deployment</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $deployment; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Property number</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $propertyNumber; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Account code</p>
                                        </div>

                                        <input class="container4" type="text" value="<?php echo $accountCode; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="unitSelected">
                            <p>SELECTED UNIT</p>
                        </div>

                        <div class="viewInfoContainer" id="viewInfoContainer1">

                            <div class="approveInfoContainer">
                                
                                <div class="subApproveInfoContainer1"  style=" width: 60%; gap: 1.5rem;">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit ID  <span style="color: red; font-size: 1.3rem;">*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="unit_ID" value="<?php echo $formattedUnitID; ?>" required>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit issue <span style="color: red; font-size: 1.3rem;">*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="report_issue" value="<?php echo $reportReason; ?>" required>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1" id="subApproveInfoContainer">

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Problem Description <span style="color: red; font-size: 1.3rem;">*</span></p>
                                        </div>

                                        <textarea class="container4" type="text" name="problem_desc" required maxlength="500" title="Maximum 500 characters allowed"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                       
                        <div class="buttonContainer2" id="buttonContainer2" style="width: 86%;">
                            <button class="button4" id="red-btn" type="button" onclick="openModal()">Remove</button>
                            <a href="unit_list.php?id=<?php echo $userID; ?>">
                                <button class="button3"  id="cancel-submit" type="button">Cancel</button>
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
                                        <h2>Are you sure you want to remove this unit?</h2>
                                    </div>
                                    <div class="alertBtn" id="alertBtn">
                                        <button class="button4" type="submit">Yes, I'm sure</button>
                                        <button class="button3" id="btn" type="button" onclick="closeModal()">Cancel</button>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
            
            </div>  
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/uploadImg.js"></script>
    <script src="../../assets/js/toggle.js"></script>

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