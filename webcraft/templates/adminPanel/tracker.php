
   
<div class="trackUnitContainer">
    <div class="subTrackUnitContainer">
        <div class="trackNameContainer">
            <div class="subTrackNameContainer">
                <p>TRACKER</p>
            </div>
        </div>

        <div class="unitInfoContainer">
            <div class="subUnitInfoContainer">
                <div class="infoContainer1">
                    <div class="subInfoContainer1" id="unitDetails">
                        <div class="unitInfo">
                            <label for="">Property number:</label>
                            <p id="propertyNumberDisplay"></p>
                        </div>

                        <div class="unitInfo">
                            <label for="">Account code:</label>
                            <p id="accountCodeDisplay"></p>
                        </div>

                        <div class="unitInfo">
                            <label for="">Unit value:</label>
                            <p id="unitValueDisplay"></p>
                        </div>

                        <div class="unitInfo">
                            <label for="">Year received:</label>
                            <p id="yearReceivedDisplay"></p>
                        </div>

                        <div class="unitInfo">
                            <label for="">Warranty status:</label>
                            <p id="warrantyStatusDisplay"></p>
                        </div>

                        <div class="unitInfo">
                            <label for="">Description:</label>
                            <p class="desc" id="descriptionDisplay"></p>
                        </div>

                        <div class="unitInfo">
                            <label for="">Remarks:</label>
                            <p id="remarksDisplay"></p>
                        </div>
                    </div>

                    <div class="imageContainer1">
                        <div class="subImageContainer1">
                            <img class="image12" id="imageDisplay" src="" alt="Equipment Image">
                        </div>

                        <div class="equipNameContainer">
                            <p id="equipmentNameDisplay"></p>
                            <p id="unitIDDisplay"></p>
                        </div>
                    </div>

                </div>
                
                <div>
                    <div class="oldUserContainer">
                        <div class="oldUserTextContainer">
                            <p>CURRENT END USER</p>
                        </div>

                        <div class="infoContainer1">
                            <div class="unitIDContainer">
                                <div class="unitInfo" id="year">
                                    <label for="">Year:</label>
                                    <p id="unitYearReceivedDisplay"></p>
                                </div>

                                <div class="unitInfo">
                                    <label for="">Name:</label>
                                    <p id="firstNameDisplay"></p>
                                    <p class="profile-link"><a href="user_profile.php?id=<?php echo $userID;?>&user_ID=<?php echo $user_ID;?>">Click here</a> to see profile</p>
                                </div>

                                <div class="unitInfo">
                                    <label for="">Username:</label>
                                    <p id="userNameDisplay"></p>
                                </div>

                                <div class="unitInfo">
                                    <label for="">E-mail:</label>
                                    <p id="emailDisplay"></p>
                                </div>

                                <div class="unitInfo">
                                    <label for="">Rank:</label>
                                    <p id="rankDisplay"></p>
                                </div>

                                <div class="unitInfo">
                                    <label for="">Designation:</label>
                                    <p id="designationDisplay"></p>
                                </div>

                                <div class="unitInfo">
                                    <label for="">Department:</label>
                                    <p id="departmentDisplay"></p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- <div class="oldUserContainer" id="oldUserContainer">
                        <div class="oldUserTextContainer">
                            <p>OLD END USER</p>
                        </div>
                    </div> -->
                        
                    <div class="oldUserContainer" id="oldUserContainer">
                        <!-- <div class="oldUserTextContainer">
                            <p>UNIT HISTORY</p>
                        </div>

                        <div class="infoContainer1" id="infoContainer1">
                            <div class="unitIssue">
                                    <div class="unitInfo">
                                    <label for="">Unit ssue:</label>
                                    <p>For return</p>
                                    </div>

                                    <div class="unitInfo">
                                    <label for="">Date:</label>
                                    <p>April 9, 202</p>
                                    </div>
                            </div>
                        </div> -->
                    </div>

                </div>
            </div>
        </div>

        <div class="buttonContainer3">
            <button  onclick="closePopup()" class="button3">Close</button>
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