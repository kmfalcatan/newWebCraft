<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";
include_once "../../functions/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required POST variables are set
    if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $sql = "SELECT password FROM users WHERE user_ID = '$userID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $current_password_hashed = $row['password'];

                if (password_verify($old_password, $current_password_hashed)) {
                    if ($new_password != $confirm_password) {
                        echo "<div class='errorMessageContainer1' style='display: block;'>
                                <div class='errorMessageContainer'>
                                    <div class='subErrorMessageContainer'>
                                        <div class='errorMessage'>
                                            <p>New password and confirm password do not match.</p>
                                        </div>
                            
                                        <div class='errorButtonContainer'>
                                            <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    } elseif (strlen($new_password) < 6) {
                        echo "<div class='errorMessageContainer1' style='display: block;'>
                                <div class='errorMessageContainer'>
                                    <div class='subErrorMessageContainer'>
                                        <div class='errorMessage'>
                                            <p>Password should be at least 6 characters long.</p>
                                        </div>
                            
                                        <div class='errorButtonContainer'>
                                            <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    } else {
                        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

                        $sql = "UPDATE users SET password = '$new_password_hashed' WHERE user_ID = '$userID'";
                        if (mysqli_query($conn, $sql)) {
                            echo "<div class='errorMessageContainer1' style='display: block;'>
                                    <div class='errorMessageContainer'>
                                        <div class='subErrorMessageContainer'>
                                            <div class='errorMessage'>
                                                <p>Password updated successfully.</p>
                                            </div>
                                
                                            <div class='errorButtonContainer'>
                                                <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        } else {
                            echo "<div class='errorMessageContainer1' style='display: block;'>
                                    <div class='errorMessageContainer'>
                                        <div class='subErrorMessageContainer'>
                                            <div class='errorMessage'>
                                                <p>Error updating password: </p>
                                            </div>
                                
                                            <div class='errorButtonContainer'>
                                                <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>" . mysqli_error($conn);
                        }
                    }
                } else {
                    echo "<div class='errorMessageContainer1' style='display: block;'>
                            <div class='errorMessageContainer'>
                                <div class='subErrorMessageContainer'>
                                    <div class='errorMessage'>
                                        <p>Old password is incorrect.</p>
                                    </div>
                        
                                    <div class='errorButtonContainer'>
                                        <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<div class='errorMessageContainer1' style='display: block;'>
                        <div class='errorMessageContainer'>
                            <div class='subErrorMessageContainer'>
                                <div class='errorMessage'>
                                    <p>User not found.</p>
                                </div>
                    
                                <div class='errorButtonContainer'>
                                    <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
        } else {
            echo "<div class='errorMessageContainer1' style='display: block;'>
                    <div class='errorMessageContainer'>
                        <div class='subErrorMessageContainer'>
                            <div class='errorMessage'>
                                <p>Error querying database: </p>
                            </div>
                
                            <div class='errorButtonContainer'>
                                <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>" . mysqli_error($conn);
        }
    } else {
        echo "<div class='errorMessageContainer1' style='display: block;'>
                <div class='errorMessageContainer'>
                    <div class='subErrorMessageContainer'>
                        <div class='errorMessage'>
                            <p>Please fill out all fields.</p>
                        </div>
            
                        <div class='errorButtonContainer'>
                            <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                        </div>
                    </div>
                </div>
            </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
                    <a href="#">
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
                        <form class="subUserInfoContainer" action="" method="post">
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

                                <div class="subInputContainer" id="subInputContainer">
                                    <div class="firstNameContainer">
                                        <div class="labelContainer">
                                            <p>New password <span>*</span></s></p>
                                        </div>

                                        <input type="password" class="subFirstNameContainer" name="new_password" required>
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

                                <div class="buttonContainer2" id="buttonContainer2">
                                    <button class="button4" id="saveButton" type="button" onclick="openModal()">Save Changes</button>
                                    <a href="my_profile.php?id=<?php echo $userID; ?>">
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

    function closeErrorMessage(){
        var close1 = document.querySelector('.errorMessageContainer1');

        if(close1.style.display === 'block'){
            close1.style.display = 'none';
        } else{
            close1.style.display = 'block'
        }
    }
    </script>
  </body>
  </html>