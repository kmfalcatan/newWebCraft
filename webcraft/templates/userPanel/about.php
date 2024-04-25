<?php
 include_once "../../authentication/auth.php";
 include_once "../../functions/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="../../assets/css/about.css">
</head>
<body>
    <div class="container">
        <div class="headerContainer">
            <p>ABOUT</p>

            <button class="backButton" type="button" onclick="goBack()">Back</button>
        </div>

        <div class="bodyContainer">
            <div class="subBodyContainer">
                <div class="textContainer">
                    <div class="aboutContainer">
                        <p>ABOUT THE SYSTEM</p>
                    </div>

                    <p>
                        Introducing MedEquip Tracker, the inventory system developed for the College of Medicine. 
                        This system allows administrators to effortlessly manage users and equipment while providing 
                        end users with the ability to handle units. With the capability to report unit issues, 
                        administrators stay informed about maintenance requirements or misplaced units. 
                        MedEquip Tracker also facilitates seamless unit transfers between staff members, ensuring efficient 
                        distribution. Furthermore, the system enables the College of Medicine to easily track specific 
                        equipment or units, providing real-time visibility. Experience the convenience of MedEquip Tracker, 
                        designed to streamline inventory management and enhance efficiency within the College of Medicine.
                    </p>
                </div>

                <div class="subTextContainer">
                    <img class="image" src="../../assets/img/system.png" alt="">
                </div>
            </div>

            <div class="subBodyContainer1">
                <div class="subTextContainer">
                    <img class="image1" style="border-radius: 0.3rem; border: 1px solid rgb(2, 116, 200);"  src="../../assets/img/client.png" alt="">
                </div>
                
                <div class="systemContainer">
                    <div class="aboutContainer">
                        <p>ABOUT THE CLIENT</p>
                    </div>

                    <p>
                        The inventory system developed for the College of Medicine department. 
                        Designed to simplify equipment management, this system is ideal for laboratory 
                        technician <strong>Ryan Jonathan Torres</strong>, who plays a crucial role in receiving 
                        equipment released by the Property Management Office (PMO). With MedEquip Tracker, 
                        <strong>Mr. Ryan</strong> can efficiently track and manage the equipment, ensuring a 
                        seamless process of receiving and organizing the resources essential for the department's 
                        scientific endeavors. Experience the power of MedEquip Tracker, tailored to meet the unique needs 
                        of laboratory technicians like Ryan Jonathan Torres in the College of Science and Mathematics.
                        <br>
                        <div class="clientContact">
                            <button class="button" onclick="openModal()">Contact Information</button>
                        </div>
                    </p>
                </div>
            </div>

            <div class="memberContainer">
                <div class="subMemberContainer">
                    <div class="memPictureContianer">
                         <div class="subMemPictureContainer">
                            <img class="subMemPictureContainer" src="../../assets/img/khriz.jpg" alt="">
                         </div>
                    </div>

                    <div class="memInfoContainer">
                        <div class="subMemInfoContainer">
                            <p>Khriz Marr L. Falcatan</p>
                        </div>

                        <div class="subMemInfoContainer1">
                            <p style="font-weight: bold;">SYSTEM ANALYST</p>
                        </div>
                    </div>
                </div>

                <div class="subMemberContainer1">
                    <div class="memPictureContianer">
                         <div class="subMemPictureContainer">
                            <img class="subMemPictureContainer" src="../../assets/img/rogie.jpg" alt="">
                         </div>
                    </div>

                    <div class="memInfoContainer">
                        <div class="subMemInfoContainer">
                            <p>Rogie E. Gabotero</p>
                        </div>

                        <div class="subMemInfoContainer1">
                            <p style="font-weight: bold;">LEAD PROGRAMMER</p>
                        </div>
                    </div>
                </div>

                <div class="subMemberContainer2">
                    <div class="memPictureContianer">
                         <div class="subMemPictureContainer">
                            <img class="subMemPictureContainer" src="../../assets/img/padwa.png" alt="">
                         </div>
                    </div>

                    <div class="memInfoContainer">
                        <div class="subMemInfoContainer">
                            <p>Padwa S. Tingkasan</p>
                        </div>

                        <div class="subMemInfoContainer1">
                            <p style="font-weight: bold;">PROJECT MANAGER</p>
                        </div>
                    </div>
                </div>

                <div class="subMemberContainer3">
                    <div class="memPictureContianer">
                         <div class="subMemPictureContainer">
                            <img class="subMemPictureContainer" src="../../assets/img/arp.png" alt="">
                         </div>
                    </div>

                    <div class="memInfoContainer">
                        <div class="subMemInfoContainer">
                            <p>Arp-j P. Villares</p>
                        </div>

                        <div class="subMemInfoContainer1">
                            <p style="font-weight: bold;">ARCHIVIST</p>
                        </div>
                    </div>
                </div>

                <div class="subMemberContainer4">
                    <div class="memPictureContianer">
                         <div class="subMemPictureContainer">
                            <img class="subMemPictureContainer" src="../../assets/img/tabs.png" alt="">
                         </div>
                    </div>

                    <div class="memInfoContainer">
                        <div class="subMemInfoContainer">
                            <p>John Mark R. Taborada</p>
                        </div>

                        <div class="subMemInfoContainer1">
                            <p style="font-weight: bold;">QA ENGINEER</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="subBodyContainer" style="margin-top: 1rem;">
                <div class="textContainer2">
                    <div class="aboutContainer1">
                        <p class="aboutDev">ABOUT THE DEVELOPER</p>
                    </div>

                    <p>
                        A cutting-edge inventory system developed by WebCraft team, a talented student 
                        from the College of Computing Studies pursuing a Bachelor of Science in 
                        Information Technology. As part of their Software Engineering subject requirements, 
                        this dedicated developer has created a comprehensive system specifically designed for 
                        the College of Medicine. MedEquip Tracker simplifies equipment tracking, user management, 
                        and unit transfers, providing a customized solution to meet the unique inventory management 
                        needs of the College of Medicine. Experience the capabilities and dedication of this 
                        student-developed system crafted to optimize inventory management within the College of Medicine.
                    </p>
                </div>
            </div>
            <div class="systemLogoContainer">
                <div class="subSystemLogoContainer">
                    <img class="subSystemLogoContainer" src="../../assets/img/webcraft_logo.png" alt="">
                </div>
            </div>

            <div class="textContainer1">
                <p>Software Engineering Project   |    Copyright  ©  2024  WebCraft</p>
            </div>
        </div>  
    </div>

     <!-- client contact -->
     <div id="clientContact1" class="clientContact1" style="display: none;">
        <div class="contactModal">
            <div class="contactContent">
                <div class="clientImg">
                <img src="../../assets/img/client.png" alt="">
                </div>
                <div class="clientDetails">
                    <div class="clientDetails1">
                        <p>Name: <span>Ryan Jonathan A. Torres</span></p>
                        <p>Username: <span>admin@wmsu</span></p>
                        <p>E-mail: <span>rjat030878@gmail.com</span></p>
                        <p>Address: <span>Baliwasa, Zamboanga City</span></p>
                    </div>
                </div>
                <div class="closebtn">
                    <p onclick="closeModal()">x</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <script> 
        function openModal() {
            var clientContact1 = document.getElementById("clientContact1");
            clientContact1.style.display = "block";
            setTimeout(function() {
                clientContact1.style.opacity = 1;
            }, 10);
        }

        function closeModal() {
            var clientContact1 = document.getElementById("clientContact1");
            clientContact1.style.opacity = 0;
            setTimeout(function() {
                clientContact1.style.display = "none";
            }, 300);
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