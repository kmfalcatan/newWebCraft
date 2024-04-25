<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";
include_once "../../functions/header.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/profile.css">

</head>
<body>
    <div class="sidebar">
        <div class="sidebarContent">
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
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>CHANGE PASSWORD</p>
                    </div>

                    <div class="subFilterContainer1">
                        <!-- <div class="trackContainer">
                            <a href="my_profile.php?id=<?php echo $userID; ?>">
                                <button class="trackButton1" id="new-equip">Edit profile</button>
                            </a>
                        </div> -->
                    </div>
                </div>

                <div class="userInfoContainer">
                    <div class="profileContainer">
                        <div class="profileContainer1">
                            <div class="profileImage">
                                <?php
                                    if (!empty($userInfo['profile_img'])) {
                                        echo '<img class="" src="../../uploads/' . $userInfo['profile_img'] . '" alt="Profile Image">';
                                    } else {
                                        echo '<img class="" src="../../assets/img/img_placeholder.jpg" alt="Mountain Placeholder">';
                                    }
                                ?>
                            </div>

                            <div class="profileInfo">
                                <p class="name"><?php echo $userInfo['first_name'] ?? ''; ?> <?php echo $userInfo['middle_initial'] ?? ''; ?>. <?php echo $userInfo['last_name'] ?? ''; ?></p>
                                <p>Administrator</p>
                            </div>
                        </div>

                        <div class="profileContainer2">
                            <div class="title">
                                <p>PERSONAL INFORMATION</p>
                            </div>
                            <div class="personalInfo">
                                <div class="personalInfo1">
                                    <p><?php echo $userInfo['username'] ?? ''; ?></p>
                                    <p><?php echo $userInfo['designation'] ?? ''; ?></p>
                                    <p><?php echo $userInfo['department'] ?? ''; ?></p>
                                    <p><?php echo $userInfo['gender'] ?? ''; ?></p>
                                    <p><?php echo $userInfo['email'] ?? ''; ?></p>
                                    <p><?php echo $userInfo['address'] ?? ''; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="editContainer">
                    <form class="subUserInfoContainer" action="../../functions/change_passwod.php" method="post" onsubmit="checkFormSubmission(event)">
                            <div class="title1">
                                <p>CHANGE PASSWORD</p>
                            </div>

                            <div id="inputContainer1">
                                <div class="subInputContainer" id="subInputContainer" style="margin-top: 1rem;">
                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Old password <span>*</span></s></p>
                                        </div>

                                        <input type="password" class="subFirstNameContainer" name="old_password" required>
                                    </div>
                                </div>

                                <div class="subInputContainer" id="subInputContainer" style="margin-top: -0.5rem;">
                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>New password <span>*</span></s></p>
                                        </div>

                                        <input type="password" class="subFirstNameContainer" name="new_password" required oninput="validatePassword(this.value)">
                                    </div>
                                </div>

                                <div class="subInputContainer" id="subInputContainer">
                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Confirm password <span>*</span></s></p>
                                        </div>

                                        <input type="password" class="subFirstNameContainer" name="confirm_password" required>
                                    </div>
                                </div>

                                <div class="passwordHint" id="subInputContainer">
                                    <div class="passwordHint1">
                                        <h3>Password Hint</h3>
                                        <p id="lengthHint">Minimum 6 characters</p>
                                        <p id="upperCaseHint">At least 1 uppercase (A - Z)</p>
                                        <p id="lowerCaseHint">At least 1 lowercase (a - z)</p>
                                        <p id="numberHint">At least 1 number (0 - 9)</p>
                                        <p id="symbolHint">At least 1 non-alphanumeric symbol (e.g., '@Z$%&!')</p>
                                    </div>
                                </div>

                                <div class="buttonContainer2" id="buttonContainer2">
                                    <button class="button4" id="saveButton" type="button" onclick="openModal()">Save Changes</button>
                                    <a href="my_profile.php?id=<?php echo urlencode($userID); ?>">
                                        <button class="button3" id="saveButton" type="button">Cancel</button>
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
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

              </div>
          </div>
      </div>

  
  <script src="../../assets/js/userList.js"></script>
  <script src="../../assets/js/sidebar.js"></script>
  <script src="../../assets/js/profile.js"></script>

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
    function validatePassword(password) {
        const lengthHint = document.getElementById("lengthHint");
        const upperCaseHint = document.getElementById("upperCaseHint");
        const lowerCaseHint = document.getElementById("lowerCaseHint");
        const numberHint = document.getElementById("numberHint");
        const symbolHint = document.getElementById("symbolHint");

        if (password.length >= 6) {
            lengthHint.style.color = "green";
            lengthHint.style.fontWeight = "bold";
        } else {
            lengthHint.style.color = "";
            lengthHint.style.fontWeight = "";
        }

        if (/[A-Z]/.test(password)) {
            upperCaseHint.style.color = "green";
            upperCaseHint.style.fontWeight = "bold";
        } else {
            upperCaseHint.style.color = "";
            upperCaseHint.style.fontWeight = "";
        }

        if (/[a-z]/.test(password)) {
            lowerCaseHint.style.color = "green";
            lowerCaseHint.style.fontWeight = "bold";
        } else {
            lowerCaseHint.style.color = "";
            lowerCaseHint.style.fontWeight = "";
        }

        if (/[0-9]/.test(password)) {
            numberHint.style.color = "green";
            numberHint.style.fontWeight = "bold";
        } else {
            numberHint.style.color = "";
            numberHint.style.fontWeight = "";
        }

        if (/[^a-zA-Z0-9]/.test(password)) {
            symbolHint.style.color = "green";
            symbolHint.style.fontWeight = "bold";
        } else {
            symbolHint.style.color = "";
            symbolHint.style.fontWeight = "";
        }
    }

    function checkFormSubmission(event) {
        const lengthHint = document.getElementById("lengthHint");
        const upperCaseHint = document.getElementById("upperCaseHint");
        const lowerCaseHint = document.getElementById("lowerCaseHint");
        const numberHint = document.getElementById("numberHint");
        const symbolHint = document.getElementById("symbolHint");

        if (
            lengthHint.style.color !== "green" ||
            upperCaseHint.style.color !== "green" ||
            lowerCaseHint.style.color !== "green" ||
            numberHint.style.color !== "green" ||
            symbolHint.style.color !== "green"
        ) {
            event.preventDefault(); 
            alert("Make sure to complete all the password requirements.");
        }
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