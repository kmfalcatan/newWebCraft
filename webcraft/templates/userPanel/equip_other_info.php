<?php
    include_once "../../dbConfig/dbconnect.php";
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include_once "../../functions/equip_info.php";
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
                    <a href="notification.php?id=<?php echo urlencode($userID); ?>">
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
                        <p>EQUIPMENT DETAILS</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <button class="trackButton1" type="button"  onclick="showWarrantyContainer()">Check warranty</button>
                            <a href="view_unit.php?id=<?php echo urlencode($userID); ?>&equipment_ID=<?php echo urlencode($equipmentID); ?>">
                                <button class="trackButton1" type="button">See unit</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                    <div class="subViewApproveContainer">
                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage" >
                                    <?php if (!empty($imageURL)): ?>
                                        <img class="equipImage2" src="../../uploads/<?php echo $imageURL; ?>" alt="">
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

                                        <div class="container4">
                                            <?php foreach ($equipInfo as $key => $info): ?>
                                                <div class="text1">
                                                    <p><?php echo $info['user']; ?><?php echo ($key < count($equipInfo) - 1) ? ', ' : ''; ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="subInfoEquipContainer2">
                                    <button onclick="popup2()" class="viewButton">View more</button>
                                    
                                    <div class="userContainer" id="userContainer" style="display: none;">
                                        <div class="viewmoreHeader">
                                            <p>NAME</p>
                                            <p>UNIT HANDLE</p>
                                        </div>

                                        <?php foreach ($equipInfo as $info): ?>
                                            <div class="subUserContainer1">
                                                <p><?php echo $info['user']; ?></p>
                                                <p class="unit"><?php echo $info['units_handled']; ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                        
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

                        <div class="viewInfoContainer" id="viewInfoContainer1" >
                            <div class="approveInfoContainer">
                                <div class="subApproveInfoContainer1" id="subApproveInfoContainer1">
                                    <div class="approveContainer" id="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Total unit </p>
                                        </div>
                                        <input class="container4" type="text" value="<?php echo $units; ?>" readonly>
                                    </div>

                                    <div class="approveContainer" id="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Total value</p>
                                        </div>
                                        <input class="container4" type="text" value="<?php echo $totalValue; ?>" readonly>
                                    </div>

                                    <div class="approveContainer" id="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Year received</p>
                                        </div>
                                        <input class="container4" type="text" value="<?php echo $yearReceived; ?>" readonly>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Remarks</p>
                                        </div>
                                        <input class="container4" type="text" value="<?php echo $remarks; ?>" readonly>
                                    </div>

                                </div>

                                <div class="subApproveInfoContainer1" id="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Description</p>
                                        </div>
                                        <textarea class="container4" type="text" readonly><?php echo $description; ?></textarea>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Instruction</p>
                                        </div>
                                        <textarea class="container4" type="text" readonly><?php echo $instruction; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            
            </div>  
        </div>
    </div>

    <div id="warrantyContainer" class="warrantyContainer" style="display: none;">
        <div class="popupModal">
            <div class="popupContent">
                <div class="logout-title" style="display: flex; align-items: center; justify-content: center;">
                    <p>Warranty</p>
                </div>
                <?php if ($warranty_status !== "No warranty available"): ?>
                    <p class="confirmsg">Warranty expiration date: <span class="date"><?php echo date('M d, Y', strtotime($warranty_end)); ?></span></p>
                    <p><span class="status" style="color: <?php echo $text_color; ?>"><?php echo $warranty_status; ?></span></p>
                <?php else: ?>
                    <p class="confirmsg"><?php echo $warranty_status; ?></p>
                <?php endif; ?>
                <div class="popupButtons">
                    <button class="button4" onclick="hideWarrantyContainer()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
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