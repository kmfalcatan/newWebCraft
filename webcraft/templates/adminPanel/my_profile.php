<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY POFILE</title>

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
                    <a href="">
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
                            <button class="trackButton1" onclick="popupForm1()">Change password <img src="../../assets/img/change-password.png" style="height: 1.6rem; width: 1.5rem; margin-left: 0.8rem;"></button>
                            <button class="trackButton1" id="btn2">Edit Profile <img src="../../assets/img/edit.png" alt=""></button>
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

                            <div class="nameContainer1">
                                <p><?php echo date('Y') . '-' . sprintf('%04d', $userInfo['user_ID'] ?? ''); ?></p>
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
                                        <p class="text"><?php echo $userInfo['middle_initial'] ?? ''; ?>.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="subInputContainer">
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
                            </div>

                            <div class="subInputContainer1">
                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>E-mail:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $userInfo['email'] ?? ''; ?></p>
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

    <script>
        var isConfirmed = false;

        function changeToConfirmSubmit() {
            var saveButton = document.getElementById("saveButton");
            saveButton.innerHTML = "Confirm Save Changes";
            saveButton.setAttribute("onclick", "confirmSubmit()");
        }

        function confirmSubmit() {
            console.log("Submit button clicked");
            isConfirmed = true;
            document.getElementById("myForm").submit(); 
        }

        document.getElementById("myForm").onsubmit = function() {
            if (!isConfirmed) {
                console.log("Please confirm save changes before submitting.");
                return false;
            }
        };
</script>

<script>
    let originalContent;

    function loadEditContent() {
        originalContent = document.querySelector('.subContainer1').innerHTML;

        document.querySelector('.subContainer1').innerHTML = `
            <div class="userInfoContainer">
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>EDIT PROFILE</p>
                        </div>
                        
                        <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <button class="trackButton1" onclick="popupForm1()">Change password <img src="../../assets/img/change-password.png" style="height: 1.6rem; width: 1.5rem; margin-left: 0.8rem;"></button>
                            <button onclick="popupForm()" class="trackButton1">Edit Profile <img src="../../assets/img/edit.png" alt=""></button>
                        </div>
                    </div>
                </div>
                <form class="subUserInfoContainer" action="../../functions/edit_profile.php" id="myForm" method="POST" enctype="multipart/form-data" style="overflow: auto;">
                    <div class="imageContainer3">
                        <div class="subImageContainer4">
                            <div class="image10">
                                <img class="image10" id="previewImage" name="profile_img" src="../../assets/img/img_placeholder.jpg" alt="">
                            </div>
                        </div>

                        <div class="nameContainer1" style="margin-top: 0.5rem;">
                            <input type="file" id="fileInput" name="profile_img" style="display: none;">
                            <button class="fileButton" id="fileButton" type="button" name="profile_img"><img src="../../assets/img/upload.png" alt="">Upload</button>
                        </div>

                        <div class="nameContainer1" style="margin: 1rem;">
                            <p><?php echo $userInfo['username'] ?? ''; ?></p>
                        </div>

                        <div class="nameContainer1">
                            <p><?php echo date('Y') . '-' . sprintf('%04d', $userInfo['user_ID'] ?? ''); ?></p>
                        </div>
                    </div>

                    <div class="inputContainer">
                        <div class="subInputContainer">
                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>First name <span>*</span></s></p>
                                </div>

                                <input type="text" class="subFirstNameContainer" name="first_name" value="<?php echo $userInfo['first_name'] ?? ''; ?>" required>
                            </div>

                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Last name <span>*</span></p>
                                </div>

                                <input type="text" class="subFirstNameContainer" name="last_name" value="<?php echo $userInfo['last_name'] ?? ''; ?>" required>
                            </div>

                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Middle Initial </p>
                                </div>

                                <input type="text" class="subFirstNameContainer" name="middle_initial" value="<?php echo $userInfo['middle_initial'] ?? ''; ?>">
                            </div>
                        </div>

                        <div class="subInputContainer">
                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Designation <span>*</span></p>
                                </div>

                                <input type="text" class="subFirstNameContainer" name="designation" value="<?php echo $userInfo['designation'] ?? ''; ?>" required>
                            </div>

                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Department <span>*</span></p>
                                </div>

                                <input type="text" class="subFirstNameContainer" name="department" value="<?php echo $userInfo['department'] ?? ''; ?>" required>
                            </div>

                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Gender <span>*</span></p>
                                </div>

                                <select class="subFirstNameContainer" name="gender" id="" value="<?php echo $userInfo['gender'] ?? ''; ?>">
                                    <option value="" selected disabled>Select a gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="subInputContainer1">
                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>E-mail <span>*</span></p>
                                </div>

                                <input type="email" class="subFirstNameContainer" name="email" value="<?php echo $userInfo['email'] ?? ''; ?>" required>
                            </div>

                            <div class="firstNameContainer">
                                <div class="labelContainer">
                                    <p>Permanent address <span>*</span></p>
                                </div>

                                <input type="text" class="subFirstNameContainer" name="address" value="<?php echo $userInfo['address'] ?? ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="buttonContainer3">
                        <button class="button2" id="saveButton" onclick="changeToConfirmSubmit()">Save Changes</button>
                        <input type="hidden" name="confirmSave" value="1">
                        <button class="button1" type="button" onclick="closeEditContent()">Cancel</button>
                    </div>
                </form>
            </div>`;
        }

        function closeEditContent() {
        document.querySelector('.subContainer1').innerHTML = originalContent;
        }

        document.getElementById('btn2').addEventListener('click', loadEditContent);
        </script>

</body>
</html>