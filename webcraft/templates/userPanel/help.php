<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../functions/header.php";
include_once "../../authentication/auth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/help.css">
</head>
<body>

    <div class="mainContainer">
        <div class="sideBarContainer3">
            <div class="headerContainer1">
                <div class="iconContainer10">
                    <button class="button3" onclick="goBack()">Back</button>
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
            
            <div class="container" >
                <div class="subContainer" id="container">
                    <p class="text">MEDEQUIP TRACKER</p>
                    <p class="text1">A quick user guide</p>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">1. AVAILABLE EQUIPMENT VIEWING</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/inventory.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>In your inventory page, you can view all the equipment available. </p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Choose one of the list and click on the corresponding view button to view equipment details.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Click on check warranty button to open the equipment warranty modal.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">4</p>
                            </div>
                            <div class="step">
                                <p>To check the equipment unit, you can click on the see unit button.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">2. AVAILBALE UNITS VIEWING</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Inside the inventory page, click the go to unit list button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>View all the avaible units.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Click on the print button to print out for the  hard copy of unit list.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/unit_list.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">3. TRACKING UNIT</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/tracking2.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Inside the inventory page, click on the Track button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Enter the available unit ID that you want to track.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Click on the track button to show the unit information.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">4</p>
                            </div>
                            <div class="step">
                                <p>Click on the close button to exit the modal.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">4. MANAGE UNITS</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Go to My profile and click on the My units button at the top.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>If needed to report specific unit, just click on the corresponding report button of your chosen unit.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Select issue base on your unit issue.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">4</p>
                            </div>
                            <div class="step">
                                <p>Complete all the required form field and submit to the admin.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/manage_units.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">5. NOTIFICATION</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help//notification.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>In your header, click on the notification icon and view all the notification you received and you've sent.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>You can view the report you've sent, the approved report notification and the unit that has transferred to your account by clicking on the view button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Filter inbox, outbox and all notification by clicking the button in your notification menu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">6. END USER BIN</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Look fo the Setting in your sidebar and select the bin, click on it.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>It will allow you to view all the removed unit that is under your monitory.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>For a case that you've lost or damanaged your unit and want to replace it, click on the replacement form button to redirect to the replacement form page.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">4</p>
                            </div>
                            <div class="step">
                                <p>Make sure to provide the required and correct information before submitting.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/enduser_bin.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">7. MANAGE PROFILE</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/enduser_edit_profile.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Go to My profile page, it will allow you to edit your personal information.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Update your profile by uploading picture of you and filling up your personal information.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Click on the save changes button to update your personal profile and wait for the success confirmation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">8. CHANGE PASSWORD</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Inside your my profile page, click on the change password button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Provide your old password and create a new password.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Make sure to apply all the given password hints.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/change_pass.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">9. LOG OUT</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/logout.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>In your side bar you can see a log out button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Click on it, and confirm logging out.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
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