<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";
include_once "../../functions/header.php";

$success_message = isset($_GET['success_message']) ? $_GET['success_message'] : '';
$error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';
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
                        <p>MY PROFILE</p>
                    </div>

                    <div id="messageModal" class="messageModal">
                        <div class="alertModal">
                            <div class="alertContent">
                                <div class="alertIcon">
                                    <div class="iconBorder" style="<?php echo !empty($success_message) ? 'border: 1px solid rgba(0, 128, 0, 0.69);' : 'border: 1px solid red;'; ?>">
                                        <?php if (!empty($success_message)): ?>
                                            <p>&#10004;</p>
                                        <?php else: ?>
                                            <p class="errorIcon" style="color: red; margin-top: -0.8rem;">&times;</p> 
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="alertMsg">
                                    <?php if (!empty($success_message)): ?>
                                        <div class="success-message"><?php echo $success_message; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($error_message)): ?>
                                        <div class="error-message"><?php echo $error_message; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="alertBtn1">
                                    <button class="closebtn">Close</button>
                                </div>
                            </div>
                        </div>
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
                            <a href="change_password.php?id=<?php echo urlencode($userID); ?>">
                                <button class="trackButton1">Change password <img src="../../assets/img/change-password.png" style="height: 1.6rem; width: 1.5rem; margin-left: 0.8rem;"></button>
                            </a>
                            <a href="view_profile.php?id=<?php echo urlencode($userID); ?>">
                                <button class="trackButton1" id="new-equip">View Only</button>
                            </a>
                        </div>
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
                                <p class="name"><?php echo $userInfo['first_name'] ?? ''; ?> <?php echo $userInfo['middle_initial'] ?? ''; ?> <?php echo $userInfo['last_name'] ?? ''; ?></p>
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
                                    <p><?php echo $userInfo['rank'] ?? ''; ?></p>
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
                        <form class="subUserInfoContainer" action="../../functions/edit_profile.php" enctype="multipart/form-data" method="post">
                            <div class="title1">
                                <p>EDIT PROFILE</p>
                            </div>

                            <div class="imageContainer3">
                                <div class="subImageContainer4">
                                    <div class="image10">
                                        <?php
                                            if (!empty($userInfo['profile_img'])) {
                                                echo '<img class="image10" id="previewImage" src="../../uploads/' . $userInfo['profile_img'] . '" alt="Profile Image">';
                                            } else {
                                                echo '<img class="image10" id="previewImage" src="../../assets/img/img_placeholder.jpg" alt="Mountain Placeholder">';
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="nameContainer1" style="margin-top: 0.5rem;">
                                    <input type="file" id="fileInput" name="profile_img" style="display: none;">
                                    <button class="fileButton" id="fileButton" type="button" name="profile_img"><img src="../../assets/img/upload.png" alt="">Upload</button>
                                </div>

                                <div class="nameContainer1">
                                    <p><?php echo $userInfo['username'] ?? ''; ?></p>
                                </div>
                            </div>

                            <div class="inputContainer">
                                <div class="subInputContainer">
                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>First name <span>*</span></s></p>
                                        </div>

                                        <input type="text" class="subFirstNameContainer" name="first_name" value="<?php echo $userInfo['first_name'] ?? ''; ?>" required maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Last name <span>*</span></p>
                                        </div>

                                        <input type="text" class="subFirstNameContainer" name="last_name" value="<?php echo $userInfo['last_name'] ?? ''; ?>" required maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Middle Initial </p>
                                        </div>

                                        <input type="text" class="subFirstNameContainer" name="middle_initial" value="<?php echo $userInfo['middle_initial'] ?? ''; ?>" maxlength="100" title="Maximum 100 characters allowed">
                                    </div>
                                </div>

                                <div class="subInputContainer">
                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Rank <span>*</span></p>
                                        </div>

                                        <input type="text" class="subFirstNameContainer" name="rank" value="<?php echo $userInfo['rank'] ?? ''; ?>" required maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Designation <span>*</span></p>
                                        </div>

                                        <input type="text" class="subFirstNameContainer" name="designation" value="<?php echo $userInfo['designation'] ?? ''; ?>" required maxlength="100" title="Maximum 100 characters allowed">
                                    </div>

                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>E-mail <span>*</span></p>
                                        </div>

                                        <input type="email" class="subFirstNameContainer" name="email" value="<?php echo $userInfo['email'] ?? ''; ?>" required maxlength="100" title="Maximum 100 characters allowed"> 
                                    </div>
                                </div>

                                <div class="subInputContainer1">
                                   <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Gender <span>*</span></p>
                                        </div>

                                        <select class="subFirstNameContainer" name="gender" id="subFirstNameContainer" value="<?php echo $userInfo['gender'] ?? ''; ?>">
                                            <option value="" selected disabled>Select a gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Department <span>*</span></p>
                                        </div>

                                        <input type="text" class="subFirstNameContainer" name="department" value="<?php echo $userInfo['department'] ?? ''; ?>" required maxlength="100" title="Maximum 100 characters allowed">
                                    </div>


                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>Permanent address <span>*</span></p>
                                        </div>

                                        <input type="text" class="subFirstNameContainer" name="address" value="<?php echo $userInfo['address'] ?? ''; ?>" required maxlength="100" title="Maximum 100 characters allowed">
                                    </div>
                                </div>

                                <div class="buttonContainer2">
                                    <button class="button4" id="saveButton" type="button" onclick="openModal()">Save Changes</button>
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
      </div>
  
  <script src="../../assets/js/userList.js"></script>
  <script src="../../assets/js/sidebar.js"></script>
  <script src="../../assets/js/profile.js"></script>
  <script src="../../assets/js/toggle.js"></script>

    <script>
        window.onload = function() {
            var modal = document.getElementById("messageModal");
            var button = document.getElementsByClassName("closebtn")[0];

            button.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            <?php if (!empty($success_message) || !empty($error_message)): ?>
                modal.style.display = "block";
            <?php endif; ?>
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