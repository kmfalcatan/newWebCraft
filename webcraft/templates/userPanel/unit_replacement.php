<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include "../dbConfig/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_ID = $_POST['user_ID'] ?? '';
    $equipmentID = $_POST['equipment_ID'] ?? '';
    $unitID = $_POST['unit_ID'] ?? ''; 
    $unit_cost = $_POST['unit_cost'] ?? '';
    $unit_specs = $_POST['unit_specs'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $replacement_date = $_POST['replacement_date'] ?? '';

    $query = "INSERT INTO unit_replacement (user_ID, equipment_ID, unit_ID, unit_cost, unit_specs, first_name, last_name, email, designation, replacement_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iissssssss", $user_ID, $equipmentID, $unitID, $unit_cost, $unit_specs, $first_name, $last_name, $email, $designation, $replacement_date);

        if ($stmt->execute()) {
            echo "<div class='errorMessageContainer1' style='display: block;'>
                    <div class='errorMessageContainer'>
                        <div class='subErrorMessageContainer'>
                            <div class='errorMessage'>
                                <p>Data successfully inserted</p>
                            </div>
                
                            <div class='errorButtonContainer'>
                                <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>";
        } else {
            echo "<div class='errorMessageContainer1' style='display: block;'>
                    <div class='errorMessageContainer'>
                        <div class='subErrorMessageContainer'>
                            <div class='errorMessage'>
                                <p>Error inserting data</p>
                            </div>
                
                            <div class='errorButtonContainer'>
                                <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>";
        }

        $stmt->close();
    } else {
        echo "<div class='errorMessageContainer1' style='display: block;'>
                <div class='errorMessageContainer'>
                    <div class='subErrorMessageContainer'>
                        <div class='errorMessage'>
                            <p>Error preparing statement</p>
                        </div>
            
                        <div class='errorButtonContainer'>
                            <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                        </div>
                    </div>
                </div>
            </div>";
    }
}


    $approved_ID = $_GET['approved_ID'];

    $query = "SELECT ar.unit_ID, ar.user_ID, ar.equipment_ID, e.article, e.property_number, e.account_code, e.image
            FROM approved_report ar
            INNER JOIN equipment e ON ar.equipment_ID = e.equipment_ID
            INNER JOIN users u ON ar.user_ID = u.user_ID
            WHERE approved_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $approved_ID);
    $stmt->execute();
    $stmt->bind_result($unitID, $user_ID, $equipmentID, $article, $propertyNumber, $accountCode, $image);
    $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIT REPORTED</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/bin.css">
    
</head>
<style>
    .container4{
        width: 95%;
    }
    
</style>
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

                <div class="subHeaderContainer1" >
                    <div class="logoNameContainer1">
                        <img class="systemName" src="../../assets/img/system-name.png" alt="">
                    </div>
                    <div class="subImageContainer3">
                        <img class="image11" src="../../assets/img/medLogo.png" alt="">
                    </div>
                </div>
            </div>

            <div class="subContainer1" id="containerToReplace">
              <div class="equipContainer">
                <div class="filterContainer1" style="width: 100%; margin-top: 0rem;">
                    <div class="inventoryNameContainer">
                        <p>UNIT REPLACEMENT</p>
                    </div>

                    <div class="subFilterContainer1">
                    </div>
                </div>
                
                <form class="subViewApproveContainer" action="../../functions/save_replacement_form.php" method="post">
                    <input type="hidden" name="user_ID" value="<?php echo $user_ID; ?>">
                    <input type="hidden" name="equipment_ID" value="<?php echo $equipmentID; ?>">
                    <input type="hidden" name="unit_ID" value="<?php echo $unitID; ?>">

                    <div class="equipImageContainer">
                        <div class="subEquipImageContainer">
                        <?php if (!empty($image)): ?>
                            <img class="subEquipImageContainer" src="../../uploads/<?php echo $image; ?>" alt="">
                        <?php else: ?>
                            <img class="subEquipImageContainer" src="../../assets/img/img_placeholder.jpg" alt="">
                        <?php endif; ?>
                        </div>
                    </div>

                    <div class="unitInfoContainer">
                        <div class="subUnitInfoContainer" id="subUnitInfoContainer">
                            <div class="unitIdContainer" id="unitIdContainer">
                                <p>Article: <span><?php echo $article; ?></span></p>
                                <p>Unit ID: <span><?php echo $unitID; ?></span><p>
                                <p>Property number: <span><?php echo $propertyNumber; ?></span></p>
                                <p>Account code: <span><?php echo $accountCode; ?></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="unitInfoContainer" id="subUnitInfoContainer1">
                        <diV class="unitContainer1">
                            <h3>UNIT INFORMATION</h3>
                        </div>

                        <div class="instruction">
                            <p>Please complete all required fields before submitting.</p>

                        </div>

                        <div class="subUnitInfoContainer">
                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>Unit cost <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="number" name="unit_cost">
                            </div>

                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer" >
                                    <p>Unit specs <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="text" name="unit_specs">
                            </div>
                        </div>
                    </div>

                    <div class="unitInfoContainer" id="subUnitInfoContainer1">
                        <div class="unitContainer1">
                            <h3>END USER INFORMATION</h3>
                        </div>
                        <div class="subUnitInfoContainer">
                            
                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>First name <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="text" name="first_name">
                            </div>

                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>Last name <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="text" name="last_name">
                            </div>
                        </div>
                    </div>

                    <div class="unitInfoContainer" style="margin-top: -1rem;">
                        <div class="subUnitInfoContainer">
                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>E-mail <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="email" name="email">
                            </div>

                            <div class="unitIdContainer">
                                <div class="subUnitIdContainer">
                                    <p>Designation <span>*</span></p>
                                </div>

                                <input class="displayUnitID" type="text" name="designation">
                            </div>
                        </div>
                    </div>

                    <div class="buttonContainer2">
                        <div class="dateReplacement">
                                <p>Date<span>*</span></p>

                            <input class="date" type="date" name="replacement_date">
                        </div>
                        <button class="button4" type="button"  onclick="openModal()">Submit</button>
                        <button  class="button3" type="button" onclick="goBack()">Cancel</button>
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
                                    <h2>Are you sure you want to submit this form?</h2>
                                </div>
                                <div class="alertBtn" id="alertBtn">
                                    <button class="button4" type="submit" id='restore' style="width: auto;">Yes, I'm sure</button>
                                    <button class="button3" id="btn" type="button" onclick="closeModal()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>  
        </div>
    </div>
</div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/uploadImg.js"></script>

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

        function closeErrorMessage(){
        var close1 = document.querySelector('.errorMessageContainer1');

        if(close1.style.display === 'block'){
            close1.style.display = 'none';
        } else{
            close1.style.display = 'block'
        }
    }

    </script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    

</body>
</html>