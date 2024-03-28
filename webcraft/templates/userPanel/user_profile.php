<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include_once "../../dbConfig/dbconnect.php";
    
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    
        $query = "SELECT * FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/user_profile.css">
    <link rel="stylesheet" href="../../assets/css/my_profile.css">
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
                        <p>USER PROFILE</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="enduser_unit.php?id=<?php echo $userID; ?>&user_id=<?php echo $user['user_ID']; ?>">
                                <button class="trackButton1">Go to user units <img src="../../assets/img/unit.png" style="height: 1.9rem;"></button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="userInfoContainer">
                    <div class="subUserInfoContainer">
                        <div class="imageContainer3">
                            <div class="subImageContainer4">
                                <div class="image10">
                                    <?php
                                        if (!empty($user['profile_img'])) {
                                            echo '<img class="image10" src="../../uploads/' . $user['profile_img'] . '" alt="Profile Image">';
                                        } else {
                                            echo '<img class="image10" src="../../assets/img/img_placeholder.jpg" alt="Mountain Placeholder">';
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="nameContainer1">
                                <p><?php echo $user['username']; ?></p>
                            </div>

                            <div class="nameContainer1">
                                <p><?php echo date('Y') . '-' . sprintf('%04d', $user['user_ID'] ?? ''); ?></p>
                            </div>
                        </div>

                        <div class="inputContainer">
                            <div class="subInputContainer">
                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>First name:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['first_name']; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Last name:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['last_name']; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Middle initial</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['middle_initial']; ?>.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="subInputContainer">
                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Designation:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['designation']; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Department:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['department']; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Gender:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['gender']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="subInputContainer1">
                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>E-mail:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['email']; ?></p>
                                    </div>
                                </div>

                                <div class="firstNameContainer">
                                    <div class="labelContainer">
                                        <p>Permanent address:</p>
                                    </div>

                                    <div class="subFirstNameContainer">
                                        <p class="text"><?php echo $user['address']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>