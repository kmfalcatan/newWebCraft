<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include_once "../../dbConfig/dbconnect.php";
    include_once "../../functions/equip_info.php";
    include_once "../../functions/edit_equipment.php";
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
                    <a href="">
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
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>EQUIPMENT DETAILS</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <button class="trackButton1" type="button"  onclick="showWarrantyContainer()">Check warranty</button>

                                <button class="trackButton1"  id="btn2" >Edit <img src="../../assets/img/edit.png" alt=""></button>

                            <div class="reportContainer"  id="reportContainer">
                                <button class="trackButton1" onclick="toggleDropdown()">Report</button>
                                <div class="dropdown-content" id="dropdownContent">
                                    <h4>UNIT REPORTING AND REMOVAL AGREEMENT</h4>
                                    <br> 
                                    <p class="agreement">By continuing to report a unit, you acknowledge that the unit will be subject to review and approval by the 
                                        administrator of the system. The decision to remove the unit from the available list will be based on the 
                                        administrator's review of the reported reason. Once approved by the administrator, the unit will be permanently 
                                        removed from the available list. However, if the unit is repaired or found, the administrator may restore it 
                                        to the available list. You agree to keep all information related to the reported unit confidential and not disclose 
                                        it to any third party without the prior written consent of the administrator.
                                    </p>
                                <br>
                                    <input type="checkbox" name="agreementCheckbox" id="agreementCheckbox" value="">
                                    <label for="agreementCheckbox">I understand and agree to the terms and conditions.</label>
                                    <a href="report.php?equipment_ID=<?php echo $equipment_ID; ?>&id=<?php echo $userID; ?>">
                                        <button class="proceed" disabled>Proceed</button>
                                    </a>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
                
                <div class="equipContainer">
                    <div class="subViewApproveContainer">
                        <div class="viewInfoContainer">
                            <div class="imageContainer4">
                                <div class="subImageContainer5">
                                    <img class="subImageContainer5" src="<?php echo $imageURL; ?>" alt="Mountain Placeholder" onerror="this.onerror=null; this.src='../../assets/img/img_placeholder.jpg';">
                                </div>

                                <div class="equipNameContainer">
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
                                            <?php foreach ($userInfo as $info): ?>
                                                <div class="text1">
                                                    <p><?php echo $info['user']; ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="subInfoEquipContainer2">
                                    <button onclick="popup2()" class="viewButton">View more</button>
                                    
                                    <div class="userContainer1" id="userContainer" style="display: none;">
                                        <div class="subUserContainer2">
                                            <p>NAME</p>
                                            <p>UNIT HANDLE</p>
                                        </div>
    
                                            <?php foreach ($userInfo as $info): ?>
                                            <div class="subUserContainer2">
                                                <p><?php echo $info['user']; ?></p>
                                                <p><?php echo $info['units_handled']; ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Deployment</p>
                                        </div>

                                        <div class="container4">
                                            <p class="text1"><?php echo $deployment; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Property number</p>
                                        </div>

                                        <div class="container4">
                                            <p class="text1" id="text1"><?php echo $property_number; ?></p>
                                        </div>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Account code</p>
                                        </div>

                                        <div class="container4">
                                            <p class="text1" id="text1"><?php echo $account_code; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="subApproveInfoContainer2">
                            <div class="approveContainer">
                                <div class="labelContainer1">
                                    <p>Total unit</p>
                                </div>

                                <div class="container4" id="container4">
                                    <p class="text1" id="text1"><?php echo $units; ?></p>
                                </div>
                            </div>

                            <div class="approveContainer">
                                <div class="labelContainer1">
                                    <p>Unit value</p>
                                </div>

                                <div class="container4">
                                    <p class="text1" id="text1"><?php echo $unit_value; ?></p>
                                </div>
                            </div>

                            <div class="approveContainer">
                                <div class="labelContainer1">
                                    <p>Total value</p>
                                </div>

                                <div class="container4">
                                    <p class="text1" id="text1"><?php echo $total_value; ?></p>
                                </div>
                            </div>

                            <div class="approveContainer">
                                <div class="labelContainer1">
                                    <p>Remarks</p>
                                </div>

                                <div class="container4">
                                    <p class="text1"><?php echo $remarks; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="descriptionContainer">
                            <div class="approveContainer1">
                                <div class="labelContainer1">
                                    <p>Description</p>
                                </div>

                                <div class="container5">
                                    <p class="text1"><?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="descriptionContainer1">
                            <div class="approveContainer1">
                                <div class="labelContainer1">
                                    <p>Instruction</p>
                                </div>

                                <div class="container5">
                                    <p class="text1"><?php echo $instruction; ?></p>
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
                <p class="confirmsg">Warranty Will Expire On: <br><span><?php echo isset($warranty_end) ? date('M d, Y', strtotime($warranty_end)) : ''; ?></span></p>
                <div class="popupButtons">
                    <button  class="button4" onclick="hideWarrantyContainer()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/toggle.js"></script>

    <script>
        document.getElementById("dropdownContent").style.display = "none";

        function toggleDropdown() {
            var dropdownContent = document.getElementById("dropdownContent");
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none"; 
            } else {
                dropdownContent.style.display = "block"; 
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var agreementCheckbox = document.getElementById("agreementCheckbox");
            var proceedButton = document.querySelector(".proceed");

            function toggleButtonState() {
                proceedButton.disabled = !agreementCheckbox.checked;
                if (proceedButton.disabled) {
                    proceedButton.style.backgroundColor = "rgba(2, 117, 200, 0.297)";
                } else {
                    proceedButton.style.backgroundColor = ""; 
                }
            }

            toggleButtonState();

            agreementCheckbox.addEventListener("change", toggleButtonState);
        });
    </script>

    <script>
        let originalContent;

        function loadEditContent() {
            originalContent = document.querySelector('.subContainer1').innerHTML;

            document.querySelector('.subContainer1').innerHTML = `
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>EDIT DETAILS</p>
                    </div>
                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <button class="trackButton1" id="btn2" type="button"  onclick="showWarrantyContainer()">Check warranty</button>
                        </div>
                    </div>
                </div>
                <div class="equipContainer">
                    <?php include('edit_equipment.php'); ?>
                </div>`;
        }

        function closeEditContent() {
            document.querySelector('.subContainer1').innerHTML = originalContent;
        }

        document.getElementById('btn2').addEventListener('click', loadEditContent);
    </script>

<script>
    function changeToConfirmSubmit() {
        var saveButton = document.getElementById("saveButton");
        saveButton.innerHTML = "Confirm Save";
        saveButton.setAttribute("onclick", "confirmSubmit()");
    }

    function confirmSubmit() {
        console.log("Submit button clicked");
    }
</script>


</body>
</html>