<?php
 include_once "../../authentication/auth.php";
?>
    <div class="userContainer">
        <div class="subUserContainer">
            <div class="userPictureContainer" >
            <a href="../userPanel/my_profile.php?id=<?php echo urlencode($userID); ?>">
                <div class="subUserPictureContainer">
                    <?php
                        if (!empty($userInfo['profile_img'])) {
                            echo '<img class="headerImg" src="../../uploads/' . $userInfo['profile_img'] . '" alt="Profile Image">';
                        } else {
                            echo '<img class="headerImg" src="../../assets/img/pp_placeholder.png" alt="Mountain Placeholder">';
                        }
                    ?>
                </div>
            </a>
            </div>
            <a href="../userPanel/my_profile.php?id=<?php echo urlencode($userID); ?>">
            <div class="userPictureContainer1">
                <p><?php echo $userInfo['username'] ?? ''; ?></p>
            </div>
            </a>
        </div>

        <div class="navContainer">
            <div class="subNavContainer">

                <a href="../userPanel/inventory.php?id=<?php echo urlencode($userID); ?>">
                    <div class="buttonContainer1">
                        <div class="iconContainer9">
                            <img class="icon" src="../../assets/img/file-text-circle.png" alt="">
                        </div>

                        <div class="nameOfIconContainer">
                            <p>Inventory</p>
                        </div>
                    </div>
                </a>

                <a href="../userPanel/user_list.php?id=<?php echo urlencode($userID); ?>">
                    <div class="buttonContainer1">
                        <div class="iconContainer9">
                            <img class="icon" id="icon" src="../../assets/img/person-circle.png" alt="" style="width: 2.5rem; height: 2.5rem;">
                        </div>

                        <div class="nameOfIconContainer">
                            <p>User list</p>
                        </div>
                    </div>
                </a>

                <a href="../userPanel/help.php?id=<?php echo urlencode($userID); ?>">
                    <div class="buttonContainer1">
                        <div class="iconContainer9">
                            <img class="icon" id="icon" src="../../assets/img/questionMark.png" alt="">
                        </div>

                        <div class="nameOfIconContainer">
                            <p>Help</p>
                        </div>
                    </div>
                </a>

                <a href="../userPanel/about.php?id=<?php echo urlencode($userID); ?>">
                    <div class="buttonContainer1">
                        <div class="iconContainer9">
                            <img class="icon" id="icon" src="../../assets/img/about-us-icon-3.jpg" style="width: 2rem;">
                        </div>

                        <div class="nameOfIconContainer">
                            <p>About</p>
                        </div>
                    </div>
                </a>

                    <div onclick="setting1()" class="buttonContainer1" style="height: 3rem; cursor: pointer;">
                        <div class="iconContainer9">
                            <img class="icon" src="../../assets/img/setting.png" alt="">
                        </div>

                        <div class="nameOfIconContainer">
                            <p>Setting</p>
                        </div>
                    </div>

                <div class="settingContainer" style="display: none;">
                    <a href="../userPanel/my_profile.php?id=<?php echo urlencode($userID); ?>">
                        <div class="buttonContainer1">
                            <div class="nameOfIconContainer">
                                <p>My profile</p>
                            </div>
                        </div>
                    </a>

                    <a href="../userPanel/bin.php?id=<?php echo urlencode($userID); ?>">
                        <div class="buttonContainer1">
                            <div class="nameOfIconContainer">
                                <p>Bin</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="subUserContainer">
            <div class="userPictureContainer">
                <div class="iconContainer9">
                    <img class="icon" src="../../assets/img/logout.png" style="width: 2rem; height: 2rem;">
                </div>
            </div>

            <div class="userPictureContainer1" onclick="showLogoutConfirmation()">
                <p>Logout</p>
            </div>
        </div>
    </div>

    <div class="arrowContainer">
        <div class="subArrowContainer">
            <img class="hideIcon" src="../../assets/img/chevron-left (1).png" alt="">
        </div>
    </div>

    <div id="logoutConfirmation" class="popupContainer" style="display: none;">
        <div class="popupModal">
            <div class="popupContent" id="popupContent">
                <div class="logout-title">
                    <p>Logout</p>
                </div>
                <p  class="confirmsg">Are you sure you want to log out?</p>
                <div class="popupButtons">
                    <button  class="button4" onclick="logout()">Yes</button>
                    <button  class="button3" onclick="hideLogoutConfirmation()" style="width: auto; padding: 0 0.7rem">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
        *Administartive Office Facility Reservation and Management System*
        *IT 132 - Software Engineering *
        *(WebCraft) Members:
            Falcatan, Khriz Marr
            Gabotero, Rogie
            Taborada, John Mark
            Tingkasan, Padwa 
            Villares, Arp-J* -->