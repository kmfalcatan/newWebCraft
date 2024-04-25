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
                    <p class="text1">A quick admin guide</p>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">1. ADDING NEW USER</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/add_user.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Click the add new user button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Complete all the required fields and make sure to provide the user existing email where their account will be sent.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Confirm to save by clicking the "Yes, I'm sure" button inside the modal.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">2. ADDING NEW ITEM</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Inside the inventory page, click the New item button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Complete all required fields and upload equipment picture.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Confirm adding new item.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/add_item.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">3. USER LISTS VIEWING</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/user_list.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Look for the user list in the side bar.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>View all the lists of users in this system.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Click on view details button to view profile of selected user.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">4. USER'S UNITS</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Inside the user profile page of specific user look for the Go to inventory button.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>View all the units handled by specific user, and you can print the unit lists by clicking on the print button at the top.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/user's_units.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">5. TRACKING UNIT</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/tracking.png" alt="">
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
                    <p class="text1">6. TRANSFER UNIT</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Go to unit lists, and click on the corresponding transfer button of the unit you want to transfer.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Choose the new end user you want to handle the unit.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Make sure to complete and provide the correct information of the new end user.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/unit_transfer.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">7. APPROVE UNIT REPORT</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help//approve_report.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>In your header, click on the notification icon and view all the notification who received from your end users.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Select one of the report sent from your notification.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Review end user's reason why the unit need to remove from the available list.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>If the end user's reason is valid, click on approve button to remove the unit form the availbale list.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">8. REMOVE UNIT</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>In your unit lists, click on the corresponding remove button of the unit you want to remove from the lists.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Select the unit issue why do you need to remove the unit.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Add additional problem issue of the unit, and click on the remove button.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/remove_unit.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">9. RESTORE REMOVED UNIT</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/restore_unit.php.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Go to your bin page, and select the removed unit you want to restore.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Click on the restore button to bring the unit back to the available lists of units.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">10. DASHBOARD VIEWING</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Click on the dashboard in your side bar.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>View the equipment and unit summary.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>You can modify the header of School Year by clicking on the edit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/dashboard.png" alt="">
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">11. MANAGE PERSONAL PROFILE</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/edit_profile.png" alt="">
                    </div>

                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Manage your profile by uploading new picture of you and filling your personal details.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Click on save changes button to update your profile details.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newEquipContainer">
                <div class="subNewEquipContainer">
                    <p class="text1">10. CHANGE PASSWORD</p>
                </div>
                <div class="imageContainer1"> 
                    <div class="stepContainer">
                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">1</p>
                            </div>
                            <div class="step">
                                <p>Click on the change password inside your profile page.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">2</p>
                            </div>
                            <div class="step">
                                <p>Enter your old password and create your new password.</p>
                            </div>
                        </div>

                        <div class="subStepContainer">
                            <div class="numberContainer">
                                <p class="text1">3</p>
                            </div>
                            <div class="step">
                                <p>Make sure to apply the password hints to be able to change your password.</p>
                            </div>
                        </div>
                    </div>

                    <div class="subImageContainer1">
                        <img class="image6" src="../../assets/img/help/change password.png" alt="">
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