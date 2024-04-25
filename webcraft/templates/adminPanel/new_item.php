<?php
 include_once "../../functions/header.php";

 $users = [];
 $query = "SELECT user_ID, first_name, last_name FROM users WHERE role = ?";
 $stmt = $conn->prepare($query);
 $role = 'user';
 $stmt->bind_param("s", $role);
 $stmt->execute();
 $result = $stmt->get_result();
 
 if ($result) {
     while ($row = $result->fetch_assoc()) {
         $users[] = $row['first_name'] . ' ' . $row['last_name'];
     }
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
    <link rel="stylesheet" href="../../assets/css/new_item.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <div class="equipContainer" >
                <div class="filterContainer1" style="width: 100%; margin-top: 0rem;" style="outline: 1px solid red;">
                    <div class="inventoryNameContainer">
                        <p>INSERT NEW ITEM</p>
                    </div>
                    
                    <div id="ImgsizeModal" class="messageModal" style="display: none;">
                        <div class="alertModal">
                            <div class="alertContent">
                                <div class="alertIcon">
                                    <div class="iconBorder" style="border: 1px solid red;">
                                        <p class="errorIcon" style="color: red; margin-top: -0.8rem;">&times;</p> 
                                    </div>
                                </div>
                                <div class="alertMsg">
                                    <div class="error-message">File size exceeds the maximum limit of 2 MB.</div>
                                </div>
                                <div class="alertBtn1">
                                    <button class="close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="inventory.php?id=<?php echo $userID; ?>">
                                <button class="trackButton1">Go to inventory <img src="../../assets/img/unit.png" style="height: 1.9rem;"></button>
                            </a>
                        </div>
                    </div>
                </div>
                
                    <form class="subViewApproveContainer" action="../../functions/save_item.php" enctype="multipart/form-data" method="post">
                        <div class="unitSelected" style="border-top: none;">
                            <div class="instruction">
                                <p>Please complete all the required fields and, if applicable, add an equipment picture before submitting the new item.</p>
                            </div>
                        </div>

                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage" >
                                    <img class="equipImage2" id="image3"  src="../../assets/img/img_placeholder.jpg" alt="Mountain Placeholder">
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
                                    <div class="approveContainer" id="approveContainer">
                                        <div class="labelContainer1">
                                            <p>End user <span>*</span></p>
                                        </div>

                                        <button class="container4" onclick="dropdown()" type="button" >Select End User</button>
                                        <div class="dropdownContainer1"  name="user" id="dropdown" style="display: none; margin-top: 4rem;">
                                            <?php
                                                foreach ($users as $enduser) {
                                                    echo '<div class="subDropDownContainer1">';
                                                    echo '<input class="checkBox" name="user" type="checkbox" onchange="handleUserSelection(this, \'' . $enduser . '\')">';
                                                    echo '<p>' . $enduser . '</p>';
                                                    echo '</div>';               
                                                    
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Article <span>*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="article" required  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Deployment <span>*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="deployment" required  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="approveContainer" id="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Distribute unit <span>*</span></p>
                                        </div>

                                        <button class="container4" type="button" onclick="dropdown2()">Distribute unit</button>

                                        <div class="dropdownContainer1" id="dropdown2" style="display: none; margin-top: 4rem;">
                                            <div class="labelContainer">
                                                <label class="label" id="user">End user</label>
                                                <label class="label" id="unit">Unit</label>
                                            </div>
                                            <div id="selectedUsersContainer2"></div> 
                                            <div class="subDropDownContainer1">
                                                <button class="saveButton"  onclick="saveUnits()" type="button">save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1">
                                     <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Total unit <span>*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="total_unit" id="totalUnits" required  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit value <span>*</span></p>
                                        </div>

                                        <input class="container4" type="text"  name="unit_value" required style="text-align: center;"  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Total value <span>*</span></p>
                                        </div>

                                        <input class="container4" type="text"  name="total_value" required style="text-align: center;"  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>
                                </div>
                                
                                <div class="subApproveInfoContainer1">
                                     <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Property number <span>*</span></p>
                                        </div>

                                        <input class="container4" type="text"  name="property_number" required  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                     <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Account code <span>*</span></p>
                                        </div>

                                        <input class="container4" type="text" name="account_code" required  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Descripton <span>*</span></p>
                                        </div>

                                        <textarea class="container5" type="text" name="description" maxlength="500" title="Maximum 500 characters allowed"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="unitSelected" >
                            <div class="instruction">

                                <p>If applicable, add additional information such as warranty details, warranty picture, and a description with instructions for the equipment.</p>
                            </div>
                        </div>

                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4">
                                <div class="equipImage" >
                                    <img class="equipImage2"  id="image4" src="../../assets/img/img_placeholder.jpg" alt="Mountain Placeholder">
                                </div>

                                <div class="uploadButtonContainer1">
                                    <label class="uploadButton1" type="button">
                                        <img class="uploadIcon1" src="../../assets/img/upload.png" alt="Upload Icon" class="uploadIcon">
                                        upload
                                        <input id="warranty_image" name="warranty_image" type="file" style="display: none;">
                                    </label>
                                </div>
                            </div>

                            <div class="approveInfoContainer">
                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Warranty start date</p>
                                        </div>

                                        <input class="container4" type="date" name="warranty_start">
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Warranty expiration date</p>
                                        </div>

                                        <input class="container4" type="date" name="warranty_end">
                                    </div>

                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Instruction <span></span></p>
                                        </div>

                                        <textarea class="container5" type="text" name="instruction"  maxlength="500" title="Maximum 500 characters allowed"></textarea>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer" id="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Remarks</p>
                                        </div>

                                        <input class="container4" type="text" name="remarks"  maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="approveContainer" id="approveContainer1">
                                        <div class="labelContainer1">
                                            <p>Year received</p>
                                        </div>

                                        <input class="container4"  id="select-year" type="year" name="year_received">
                                    </div>
                                </div>

                                <div class="buttonContainer2">
                                    <button class="button4" id="confirm-submit" type="button" onclick="openModal()">Save item</button>
                                    <a href="inventory.php?id=<?php echo $userID; ?>">
                                        <button class="button3" type="button">Cancel</button>
                                    </a>
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
                                        <h2>Are you sure you want to save this item?</h2>
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
    <script src="../../assets/js/newItem.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/uploadImg.js"></script>

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