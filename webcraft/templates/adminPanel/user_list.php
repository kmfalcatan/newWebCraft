<?php
 include_once "../../functions/header.php";

    $sql = "SELECT * FROM users WHERE role = 'user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $users = array();

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    } else {
        $users = array();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/userList.css">
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
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>USER LIST</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                        <button class="trackButton1">Sort <img src="../../assets/img/sort.png" alt="" style="margin-left: 0.5rem; width: 1.4rem; height: 1.2rem;"></button>
                            <button onclick="popUp2()" class="trackButton1">Add user <span class="plusIcon">+</span></button>
                        </div>
                    </div>
                </div>

                <div class="userListContainer">
                    <div class="subUserListContainer">
                        <?php foreach ($users as $user): ?>
                        <div class="userContainer4">
                            <div class="subUserContainer1" >
                                <div class="imageContainer4">
                                    <div class="subImageContainer4">
                                    <?php if (!empty($user['profile_img'])): ?>
                                        <img class="image4" src="../uploads/<?php echo $user['profile_img']; ?>" alt="">
                                    <?php else: ?>
                                        <img class="image4" src="../../assets/img/pp_placeholder.png" >
                                    <?php endif; ?>
                                    </div>
                                </div>
    
                                <div class="userNameContainer">
                                    <p><?php echo $user['first_name']; ?> <?php echo $user['middle_initial']; ?> <?php echo $user['last_name']; ?></p>
                                </div>
                            </div>

                            <div class="viewButtonContainer">
                                <a href="../adminPanel/user_profile.php?id=<?php echo $userID; ?>&user_id=<?php echo $user['user_ID']; ?>">
                                <button class="viewButton">View details</button>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="addUserContainer" style="display: none;">
                        <form class="addUserContainer" action="../../functions/save_user.php" method="POST" onsubmit="return validateForm()">
                            <div class="subAddUserContainer">
                                <div class="trackNameContainer">
                                    <div class="subTrackNameContainer">
                                        <p>ADD NEW USER</p>
                                    </div>
                                </div>

                                <div class="infoContainer2">
                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>Last name <span>*</span></p>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="text" class="inputName" name="last_name" required>
                                        </div>
                                    </div>
    
                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>First name  <span>*</span></p>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="text" class="inputName" name="first_name" required>
                                        </div>
                                    </div>
    
                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>Middle initial <span class="mi">(optional)</span></p>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="text" class="inputName" name="middle_initial">
                                        </div>
                                    </div>
    
                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>Designation  <span>*</span></p>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="text" class="inputName" name="designation" required>
                                        </div>
                                    </div>
    
                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>E-mail  <span>*</span></p>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="email" class="inputName" name="email" required>
                                        </div>
                                    </div>

                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>Username  <span>*</span></p>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="text" class="inputName" name="username" required>
                                        </div>
                                    </div>
    
                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>Default password  <span>*</span></p>
                                            <div id="password-strength"></div>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="password" class="inputName" id="password" name="password" required>
                                        </div>
                                    </div>
    
                                    <div class="userInfoContainer">
                                        <div class="textContainer">
                                            <p>Confirm password  <span>*</span></p>
                                        </div>
    
                                        <div class="inputNameContainer">
                                            <input type="password" class="inputName" name="confirmPassword" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="buttonContainer4">
                                    <button type="button" onclick="popUp2()" class="button3">Cancel</button>
                                    <button id="saveButton" class="button4" onclick="changeToConfirmSubmit()">Save</button>
                                    <input type="hidden" name="confirmSave" value="1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>

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

    <script src="../../assets/js/password_checker.js"></script>
    <script src="../../assets/js/userList.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>