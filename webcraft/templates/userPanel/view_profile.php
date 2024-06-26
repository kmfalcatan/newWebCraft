<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
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
    <link rel="stylesheet" href="../../assets/css/user_profile.css">
    <link rel="stylesheet" href="../../assets/css/my_profile.css">
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
                    <a href="notification.php?id=<?php echo urlencode($userID); ?>">
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
            
            <div class="subContainer1">
                <div class="userInfoContainer">     
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>MY PROFILE</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="change_password.php?id=<?php echo urlencode($userID); ?>">
                                <button class="trackButton1">Change password <img src="../../assets/img/change-password.png" style="height: 1.6rem; width: 1.5rem; margin-left: 0.8rem;"></button>
                            </a>
                            <a href="my_profile.php?id=<?php echo urlencode($userID); ?>">
                                <button class="trackButton1" id="btn2">Edit Profile <img src="../../assets/img/edit.png" alt=""></button>
                            </a>    
                        </div>
                    </div>
                </div>

                    <div class="subUserInfoContainer">
                        <div class="imageContainer3">
                            <div class="subImageContainer4">
                                <div class="image10">
                                    <?php
                                        if (!empty($userInfo['profile_img'])) {
                                            echo '<img class="image10" src="../../uploads/' . $userInfo['profile_img'] . '" alt="Profile Image">';
                                        } else {
                                            echo '<img class="image10" src="../../assets/img/img_placeholder.jpg" alt="Mountain Placeholder">';
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="nameContainer1" style="margin-top: 1rem;">
                                <p><?php echo $userInfo['username'] ?? ''; ?></p>
                            </div>
                        </div>

                        <div class="inputContainer">
                            <div class="subInputContainer">
                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>First name:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['first_name'] ?? ''; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Last name:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['last_name'] ?? ''; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Middle Initial:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['middle_initial'] ?? ''; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="subInputContainer">
                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Rank:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['rank'] ?? ''; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Designation:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['designation'] ?? ''; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>E-mail:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['email'] ?? ''; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="subInputContainer1">
                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Department:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['department'] ?? ''; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Gender:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['gender'] ?? ''; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Permanent address:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['address'] ?? ''; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

    <div class="changepassContainer" style="display: none;">
        <div class="changepassContainer">
            <div class="userInfoContainer">
                <form class="subUserInfoContainer1" action="../../functions/change_passwod.php" method="POST" style="width: auto;">
                        <div class="trackNameContainer">
                            <div class="subTrackNameContainer">
                                <p>CHANGE PASSWORD</p>
                            </div>
                        </div>
                        <div id="alert">
                            <?php
                                if (isset($error_message)) {
                                    echo "<div class='error-message'>$error_message</div>";
                                }
                                if (isset($success_message)) {
                                    echo "<div class='success-message'>$success_message</div>";
                                }
                            ?>
                        </div>

                        <div class="subInputContainer" style="margin-top: 1.5rem;">
                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Old password <span>*</span></s></p>
                                </div>

                                <input type="password" class="subFirstNameContainer" name="old_password" required>
                            </div>
                        </div>

                        <div class="subInputContainer">
                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>New password <span>*</span></s></p>
                                </div>

                                <input type="password" class="subFirstNameContainer" name="new_password" required>
                            </div>
                        </div>

                        <div class="subInputContainer">
                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Confirm password <span>*</span></s></p>
                                </div>

                                <input type="password" class="subFirstNameContainer" name="confirm_password" required>
                            </div>
                        </div>
        
                        <div class="buttonContainer2">
                            <button class="button4" id="saveButton" onclick="changeToConfirmSubmit()">Save</button>
                            <input type="hidden" name="confirmSave" value="1">
                            <button type="button" class="button3" onclick="popupForm1()">Cancel</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/profile.js"></script>

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