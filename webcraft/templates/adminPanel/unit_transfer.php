<?php
    include_once "../../dbConfig/dbconnect.php";
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";

    $unitID = $_GET['unitID'] ?? '';
    $selectedUser = $_GET['selectedUser'] ?? '';

    $userData = json_decode(htmlspecialchars_decode($selectedUser), true);
    $firstName = $userData[0];
    $lastName = $userData[1];
    $new_end_userID = $userData[2]; 

    $formattedUnitID = 'UNIT-' . str_pad($unitID, 4, '0', STR_PAD_LEFT);

    $sql = "SELECT equipment_ID, user FROM units WHERE unit_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $unitID);
    $stmt->execute();
    $stmt->bind_result($equipmentID, $currentUser);
    $stmt->fetch();
    $stmt->close();

    $sql = "SELECT article, account_code, property_number, image FROM equipment WHERE equipment_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $equipmentID);
    $stmt->execute();
    $stmt->bind_result($article, $accountCode, $propertyNumber, $image);
    $stmt->fetch();
    $stmt->close();

    $sql = "SELECT user_ID, first_name, last_name, email FROM users WHERE CONCAT(first_name, ' ', last_name) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currentUser);
    $stmt->execute();
    $stmt->bind_result($current_end_userID, $current_firstName, $current_lastName, $current_email);
    $stmt->fetch();
    $stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIT REPORTED</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/bin.css">
    
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
                        <p>UNIT TRANSFER</p>
                    </div>

                    <div class="subFilterContainer1">
                    </div>
                </div>
                
                <form class="subViewApproveContainer" action="../../functions/save_unit_transfer.php" method="post">
                    <input type="hidden" name="equipment_ID" value="<?php echo $equipmentID; ?>">
                    <input type="hidden" name="unit_ID" value="<?php echo $formattedUnitID; ?>">
                    <input type="hidden" name="new_end_userID" value="<?php echo $new_end_userID; ?>">
                    <input type="hidden" name="old_end_userID" value="<?php echo $current_end_userID; ?>">

                    <div class="equipImageContainer">
                        <div class="subEquipImageContainer">
                            <?php if (!empty($image)): ?>
                                <img class="subEquipImageContainer" src="../../uploads/<?php echo $image; ?>" alt="">
                            <?php else: ?>
                                <img class="subEquipImageContainer" src="../../assets/img/img_placeholder.jpg" alt="">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="unitInfoContainer">
                        <div class="subUnitInfoContainer" id="subUnitInfoContainer">
                            <div class="unitIdContainer" id="unitIdContainer">
                                <p>Article: <span><?php echo $article; ?></span></p>
                                <p>Unit ID: <span><?php echo $formattedUnitID; ?><span><p>
                                <p>Account code: <span><?php echo $accountCode; ?></span></p>
                                <p>Property number: <span><?php echo $propertyNumber; ?><span></p>
                            </div>
                        </div>
                    </div>

                    <div class="unitInfoContainer" id="subUnitInfoContainer1">
                        <diV class="unitContainer1">
                            <h3>CURRENT END USER INFORMATION</h3>
                        </div>
                        

                        <div class="subUnitInfoContainer">
                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>First name</p>
                                </div>

                                <input class="displayUnitID" type="text" name="old_end_user_first_name" value="<?php echo $current_firstName; ?>">
                            </div>

                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer" >
                                    <p>Last name</p>
                                </div>

                                <input class="displayUnitID" type="text" name="old_end_user_last_name" value="<?php echo $current_lastName; ?>">
                            </div>

                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer" >
                                    <p>E-mail</p>
                                </div>

                                <input class="displayUnitID" type="text" name="" value="<?php echo $current_email; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="unitInfoContainer" id="subUnitInfoContainer1">
                        <div class="unitContainer1">
                            <h3>NEW END USER INFORMATION</h3>
                        </div>

                        <div class="instruction">
                            <p>Please complete all required fields before submitting.</p>

                        </div>

                        <div class="subUnitInfoContainer">
                            
                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>First name <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="text" name="new_end_user_first_name" value="<?php echo $firstName; ?>" required>
                            </div>

                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer" >
                                    <p>Last name <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="text" name="new_end_user_last_name" value="<?php echo $lastName; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="unitInfoContainer" style="margin-top: -1rem;">
                        <div class="subUnitInfoContainer">
                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>E-mail <span>*</span></p>
                                </div>
 
                                <input class="displayUnitID" type="email" name="email" required>
                            </div>

                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>Designation <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="text" name="designation" required>
                            </div>
                        </div>
                    </div>

                    <div class="buttonContainer2">
                        <div class="dateReplacement">
                                <p>Date<span>*</span></p>

                            <input class="date" type="date" name="date_transfer">
                        </div>
                        <button class="button4" type="button"  onclick="openModal()">Submit</button>
                        <button  class="button3" type="button" onclick="goBack()">Cancel</button>
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
                                    <h2>Are you sure you want to submit this form?</h2>
                                </div>
                                <div class="alertBtn" id="alertBtn">
                                    <button class="button4" type="submit" id='restore' style="width: auto;">Yes, I'm sure</button>
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

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    

</body>
</html>