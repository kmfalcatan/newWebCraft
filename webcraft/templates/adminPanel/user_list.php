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
                    <a href="notification.php?id=<?php echo $userID; ?>">
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
                            <button  class="trackButton1" id="btn2" >Add user <span class="plusIcon">+</span></button>
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
                                        <img class="image4" src="../../uploads/<?php echo $user['profile_img']; ?>" alt="">
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
                                <a href="../adminPanel/user_profile.php?id=<?php echo $userID; ?>&user_ID=<?php echo $user['user_ID']; ?>">
                                <button class="viewButton">View details</button>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>  
        </div>
    </div>

   
    <script>
        let originalContent;

        function loadEditContent() {
            originalContent = document.querySelector('.subContainer1').innerHTML;

            document.querySelector('.subContainer1').innerHTML = `
                <?php include("add_user.php"); ?>
                </div>`;
        }

        function closeEditContent() {
            document.querySelector('.subContainer1').innerHTML = originalContent;
        }

        document.getElementById('btn2').addEventListener('click', loadEditContent);
    </script>

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

    
    <script src="../../assets/js/password_checker.js"></script>
    <script src="../../assets/js/userList.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

</body>
</html>