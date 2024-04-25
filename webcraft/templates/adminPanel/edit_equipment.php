<?php
    include_once "../../dbConfig/dbconnect.php";
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include_once "../../functions/equip_info.php";

    $equipmentID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;
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
                        <p>EDIT EQUIPMENT DETAILS</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <button class="trackButton1" type="button"  onclick="showWarrantyContainer()">Check warranty</button>
                        </div>
                    </div>
                </div>
                
                <form class="subViewApproveContainer" action="../../functions/edit_equipment.php" enctype="multipart/form-data" method="post">
                    <div class="viewInfoContainer" id="viewInfoContainer">
                        <div class="imageContainer4" >
                            <div class="equipImage" >
                                <?php if (!empty($imageURL)): ?>
                                    <img class="equipImage2" id="image3" src="../../uploads/<?php echo $imageURL; ?>" alt="">
                                <?php else: ?>
                                    <img class="equipImage2" id="image3" src="../../assets/img/img_placeholder.jpg" alt="">
                                <?php endif; ?>
                            </div>

                            <div class="uploadButtonContainer1">
                                <label class="uploadButton1" type="button">
                                    <img class="uploadIcon1" src="../../assets/img/upload.png" alt="Upload Icon" class="uploadIcon">
                                    upload
                                    <input id="image" name="image" type="file" style="display: none;">
                                </label>
                            </div>
                        </div>

                        <div class="approveInfoContainer">
                            <div class="subApproveInfoContainer">
                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Article</p>
                                    </div>

                                    <input class="container4" type="text" name="article" value="<?php echo $article; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                    <input type="hidden" name="equipment_ID" value="<?php echo $equipmentID; ?>">
                                </div>
                            </div>

                            <div class="subApproveInfoContainer">
                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Deployment</p>
                                    </div>

                                    <input class="container4" type="text" name="deployment" value="<?php echo $deployment; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                </div>
                            </div>

                            <div class="subApproveInfoContainer1">
                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Property number</p>
                                    </div>

                                    <input class="container4" type="text" name="property_number" value="<?php echo $propertyNumber; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                </div>

                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Account code</p>
                                    </div>

                                    <input class="container4" type="text" name="account_code" value="<?php echo $accountCode; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="viewInfoContainer" id="viewInfoContainer1">

                        <div class="approveInfoContainer">
                            
                            <div class="subApproveInfoContainer1" id="subApproveInfoContainer1">
                                <div class="approveContainer" id="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Total unit </p>
                                    </div>

                                    <input class="container4" type="number" name="total_unit" value="<?php echo $units; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                </div>

                                <div class="approveContainer" id="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Total value</p>
                                    </div>

                                    <input class="container4" type="text" name="total_value" value="<?php echo $totalValue; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                </div>

                                <div class="approveContainer" id="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Year released</p>
                                    </div>

                                    <input class="container4" type="number" name="year_received" value="<?php echo $yearReceived; ?>">
                                </div>

                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Remarks</p>
                                    </div>

                                    <input class="container4" type="text" name="remarks" value="<?php echo $remarks; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                </div>
                            </div>

                            <div class="subApproveInfoContainer1" id="subApproveInfoContainer">

                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Description</p>
                                    </div>

                                    <textarea class="container4" type="text" name="description" style="width: 98%;" maxlength="500" title="Maximum 500 characters allowed"><?php echo $description; ?></textarea>
                                </div>
                            </div>

                            <div class="subApproveInfoContainer1" id="subApproveInfoContainer">
                                <div class="approveContainer" id="instruction">
                                    <div class="labelContainer1">
                                        <p>Instruction</p>
                                    </div>

                                    <textarea class="container4" type="text" name="instruction" style="width: 98%; " maxlength="500" title="Maximum 500 characters allowed"><?php echo $instruction; ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="buttonContainer2" id="buttonContainer2" style="margin-top: 1.5rem;">
                        <button  class="button4" id="confirm-submit" type="button" onclick="openModal()">Save changes</button>
                        <a href="equip_other_info.php?id=<?php echo urlencode($userID); ?>&equipment_ID=<?php echo urlencode($equipmentID); ?>">
                            <button  class="button3" type="button">Cancel</button>
                        </a>
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
                                    <h2>Are you sure you want to save changes?</h2>
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

<!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
    *Administartive Office Facility Reservation and Management System*
    *IT 132 - Software Engineering *
    *(WebCraft) Members:
        Falcatan, Khriz Marr
        Gabotero, Rogie
        Taborada, John Mark
        Tingkasan, Padwa 
        Villares, Arp-J* -->