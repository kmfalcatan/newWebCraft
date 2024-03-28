<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/change_password.css">
    <link rel="stylesheet" href="../../assets/css/setting.css">
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
                <div class="logoNameContainer1">
                    <img class="systemName" src="../../assets/img/system-name.png" alt="">
                </div>
                <div class="subImageContainer3">
                    <img class="image11" src="../../assets/img/medLogo.png" alt="">
                </div>
            </div>

            <div class="container">
                <div class="topContainer">
                    <img class="top-img" src="../assets/img/change-password-icon-clipart-7-removebg-preview.png" alt="" >
                    <h2>CHANGE PASSWORD</h2>
                </div>
                <div class="subContainer1">
                    <form method="POST">
                        <div id="alert">
                                <div class='error-message'>$error_message</div>
                                <div class='success-message'>$success_message</div>
                        </div>
                   
                        <div class="inputPassContainer">
                            <input type="password" name="old_password" placeholder="Old password" required>
                        </div>
        
                        <div class="inputPassContainer">
                            <input type="password" name="new_password" placeholder="New password" required>
                        </div>
        
                        <div class="inputPassContainer">
                            <input type="password" name="confirm_password" placeholder="Confirm password" required>
                        </div>
        
                        <div class="inputPassContainer">
                            <button type="submit" class="button">Save</button>
                            <a href="../admin panel/setting.php?id=<?php echo $userID; ?>">
                                <button type="button" class="button">Back</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>