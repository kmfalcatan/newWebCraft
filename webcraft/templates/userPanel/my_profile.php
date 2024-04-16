<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../authentication/auth.php";
include_once "../../functions/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleInitial = $_POST['middle_initial'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $profile_img = '';
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['profile_img']['tmp_name'];
        $filename = $_FILES['profile_img']['name'];
        $profile_img = $filename;
        move_uploaded_file($tmp_name, '../uploads/' . $profile_img);
    }

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, middle_initial=?, designation=?, department=?, email=?, address=?, gender=?, profile_img=? WHERE user_ID = '$userID'");

    $stmt->bind_param("sssssssss", $firstName, $lastName, $middleInitial, $designation, $department, $email, $address, $gender, $profile_img);

    if ($stmt->execute()) {
        echo "<div class='errorMessageContainer1' style='display: block;'>
                <div class='errorMessageContainer'>
                    <div class='subErrorMessageContainer'>
                        <div class='errorMessage'>
                            <p>Data updated successfully</p>
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
                            <p>Error updating data:</p>
                        </div>
            
                        <div class='errorButtonContainer'>
                            <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                        </div>
                    </div>
                </div>
            </div>" . $stmt->error;
    }

    $stmt->close();

    $userID = $_SESSION['user_id'];
    $userInfo = getUserInfo($conn, $userID);
    $role = $userInfo['role'];

    if ($role === 'admin') {
        header("Location: ../templates/adminPanel/my_profile.php?id={$userID}");
    } else {
        header("Location: ../templates/userPanel/my_profile.php?id={$userID}");
        exit();
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
                        <p>MY PROFILE</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="change_password.php?id=<?php echo $userID; ?>">
                                <button class="trackButton1">Change password <img src="../../assets/img/change-password.png" style="height: 1.6rem; width: 1.5rem; margin-left: 0.8rem;"></button>
                            </a>
                            <a href="my_units.php?id=<?php echo $userID; ?>">
                                <button class="trackButton1" id="new-equip">My units</button>
                            </a>
                            <a href="view_profile.php?id=<?php echo $userID; ?>">
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
                                <p class="name"><?php echo $userInfo['first_name'] ?? ''; ?> <?php echo $userInfo['middle_initial'] ?? ''; ?>. <?php echo $userInfo['last_name'] ?? ''; ?></p>
                                <p>End user</p>
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

                                        <select class="subFirstNameContainer" name="gender" id="subFirstNameContainer" value="<?php echo $userInfo['gender'] ?? ''; ?>">
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