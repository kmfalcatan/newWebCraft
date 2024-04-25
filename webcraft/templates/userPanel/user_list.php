<?php
 include_once "../../functions/header.php";

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

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
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
                                <a href="../userPanel/user_profile.php?id=<?php echo urlencode($userID); ?>&user_ID=<?php echo urlencode($user['user_ID']); ?>">
                                    <button class="viewButton">View profile</button>
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

    <script src="../../assets/js/userList.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

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