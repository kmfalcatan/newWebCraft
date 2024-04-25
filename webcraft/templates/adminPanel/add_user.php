
<link rel="stylesheet" href="../../assets/css/user_list.css">
<style>
     .subUserListContainer{
        display: flex;
        justify-content: space-between;
        align-items: start;
        overflow: hidden;
        flex-direction: row;
        height: 99%;
    }
</style>

<div class="subContainer1">
    <div class="filterContainer1">
        <div class="inventoryNameContainer">
            <p>ADD USER</p>
        </div>

        <div class="subFilterContainer1">
            <div class="searchContainer1">
                <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
            </div>
        </div>
    </div>

    <div class="userListContainer" >
        <div class="subUserListContainer" style="border: 1px solid #b8b8b8;">
            <div class="userContainer3" style="overflow-y: auto;">

                <?php foreach ($users as $user): ?>
                    <div class="userContainer4" >
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
                                <a href="../adminPanel/user_profile.php?id=<?php echo $userID; ?>&user_ID=<?php echo $user['user_ID']; ?>">
                                <button class="viewButton">View details</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <form class="subAddUserContainer" action="../../functions/save_user.php" method="post"  onsubmit="checkFormSubmission(event)">

                <div class="infoContainer2">
                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>Last name <span>*</span></p>
                        </div>

                        <div class="inputNameContainer">
                            <input type="text" class="inputName" name="last_name" required maxlength="100" title="Maximum 100 characters allowed">
                        </div>
                    </div>

                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>First name  <span>*</span></p>
                        </div>

                        <div class="inputNameContainer">
                            <input type="text" class="inputName" name="first_name" required maxlength="100" title="Maximum 100 characters allowed">
                        </div>
                    </div>

                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>Middle initial <span class="mi">(optional)</span></p>
                        </div>

                        <div class="inputNameContainer">
                            <input type="text" class="inputName" name="middle_initial" maxlength="100" title="Maximum 100 characters allowed">
                        </div>
                    </div>

                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>Rank  <span>*</span></p>
                        </div>

                        <div class="inputNameContainer">
                            <input type="text" class="inputName" name="rank" required maxlength="100" title="Maximum 100 characters allowed">
                        </div>
                    </div>

                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>Designation  <span>*</span></p>
                        </div>

                        <div class="inputNameContainer">
                            <input type="text" class="inputName" name="designation" required maxlength="100" title="Maximum 100 characters allowed">
                        </div>
                    </div>

                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>E-mail  <span>*</span></p>
                        </div>

                        <div class="inputNameContainer">
                            <input type="email" class="inputName" name="email" required maxlength="100" title="Maximum 100 characters allowed">
                        </div>
                    </div>

                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>Username  <span>*</span></p>
                        </div>

                        <div class="inputNameContainer">
                            <input type="text" class="inputName" name="username" required maxlength="100" title="Maximum 100 characters allowed">
                        </div>
                    </div>

                    <div class="userInfoContainer">
                        <div class="textContainer">
                            <p>Default password  <span>*</span></p>
                            <div id="password-strength"></div>
                        </div>

                        <div class="inputNameContainer">
                            <input type="password" class="inputName" id="password" name="password" required oninput="validatePassword(this.value)">
                        </div>
                    </div>

                    <div class="passwordHint">
                        <div class="passwordHint1">
                            <h3>Password Hint</h3>
                            <p id="lengthHint">Minimum 6 characters</p>
                            <p id="upperCaseHint">At least 1 uppercase (A - Z)</p>
                            <p id="lowerCaseHint">At least 1 lowercase (a - z)</p>
                            <p id="numberHint">At least 1 number (0 - 9)</p>
                            <p id="symbolHint">At least 1 non-alphanumeric symbol (e.g., '@Z$%&!')</p>
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
                    <button id="saveButton" class="button4" type="button"  onclick="openModal()">Save</button>
                    <button class="button3" type="button" onclick="closeEditContent()">Cancel</button>
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
                                <h2>Are you sure you want to save user?</h2>
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

<!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
    *Administartive Office Facility Reservation and Management System*
    *IT 132 - Software Engineering *
    *(WebCraft) Members:
        Falcatan, Khriz Marr
        Gabotero, Rogie
        Taborada, John Mark
        Tingkasan, Padwa 
        Villares, Arp-J* -->
