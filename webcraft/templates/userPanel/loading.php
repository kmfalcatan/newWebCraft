<?php
 include_once "../../authentication/auth.php";
 include_once "../../dbConfig/dbconnect.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="../../assets/css/loading.css">
    <style>
        .image7 {
            height: 20rem;
            animation: fadeIn 1.5s linear, spin 6s infinite linear;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <div class="subContainer1">
            <div class="imageContainer4">
                <img class="image11" src="assets/img/microscope_icon.png" alt="">
            </div>

            
            <div class="imageContainer4">
                <img class="image12" src="assets/img/thermometer-png-4.png" alt="">
            </div>
        </div> -->

        <div class="subContainer">
            <!-- <div class="imageContainer2">
                <img class="image16" src="assets/img/medicine_icon.png" alt="">
            </div> -->
            <div class="image6">

                
                <div class="imageContainer1">
                    <img class="image7" src="../../assets/img/wmsu_logo_border.png" alt="">
                    <img class="image8" src="../../assets/img/wmsu_logo_book.png" alt="">
                    <img class="image9" src="../../assets/img/wmsu_logo_part.png" alt="">
                    <img class="image10" src="../../assets/img/wmsu_logo_eagle.png" alt="">
                </div>
            </div>

            <!-- <div class="imageContainer2">
                <img class="image15" src="assets/img/syringe.png" alt="">
            </div> -->
        </div>

        
        <!-- <div class="subContainer1">
            <div class="imageContainer4">
                <img class="image13" src="assets/img/stethoscope.png" alt="">
            </div>

            
            <div class="imageContainer4">
                <img class="image14" src="assets/img/wheel-_chair.png" alt="">
            </div>
        </div> -->
    </div>

    <script src="../../assets/js/loading.js"></script>
    <script>
        setTimeout(() => {
            stopSpinningAndRedirect();
        }, 3000);

        function stopSpinningAndRedirect() {
            var image7 = document.querySelector('.image7');
            image7.style.animation = 'fadeIn 0.4s linear';
            
            window.location.href = 'inventory.php?id=<?php echo $userID; ?>';
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