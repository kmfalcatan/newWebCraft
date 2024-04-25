<?php
 include_once "../../functions/header.php";

$success_message = isset($_GET['success_message']) ? $_GET['success_message'] : '';
$error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';

 $sql = "SELECT * FROM users WHERE role = ?";
 $stmt = $conn->prepare($sql);
 $role = "user"; 
 $stmt->bind_param("s", $role);
 
 $stmt->execute();
 $result = $stmt->get_result();
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
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

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
                        <p>USER LIST</p>
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

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <button  class="trackButton1" id="btn2" style="width: 7rem; font-size: 0.9rem;">Add user <span class="plusIcon">+</span></button>
                        </div>
                    </div>
                </div>

                <div class="userListContainer">
                    <div class="subUserListContainer">
                        <?php foreach ($users as $user): ?>
                        <div class="userContainer4">
                            <div class="userContainer5">
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
                                    <a href="../adminPanel/user_profile.php?id=<?php echo urlencode($userID); ?>&user_ID=<?php echo urlencode($user['user_ID']); ?>">
                                        <button class="viewButton">View details</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <div class="noResultsFound" style="display: none;">
                            <p>No results found</p>
                        </div>
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

    <script src="../../assets/js/userList.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

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