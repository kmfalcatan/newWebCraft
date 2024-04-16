<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";

    $replacementID = $_GET['replacement_ID'];

    $replacementQuery = "SELECT user_ID, equipment_ID, unit_ID, unit_cost, unit_specs, first_name, last_name, email, designation, timestamp FROM unit_replacement WHERE replacement_ID = ?";
    $stmt = $conn->prepare($replacementQuery);
    
    if ($stmt) {
        $stmt->bind_param("i", $replacementID);
        $stmt->execute();
        $stmt->bind_result($user_ID, $equipmentID, $unitID, $unitCost, $unitSpecs, $firstName, $lastName, $email, $designation, $timestamp);
        $stmt->fetch();
    
        $stmt->close();
    
        $equipmentQuery = "SELECT article, property_number, account_code, image FROM equipment WHERE equipment_ID = ?";
        $stmt2 = $conn->prepare($equipmentQuery);
    
        if ($stmt2) {
            $stmt2->bind_param("i", $equipmentID);
            $stmt2->execute();
            $stmt2->bind_result($article, $propertyNumber, $accountCode, $image);
            $stmt2->fetch();
    
            $stmt2->close();
        } else {
            echo "<div class='errorMessageContainer1' style='display: block;'>
            <div class='errorMessageContainer'>
                <div class='subErrorMessageContainer'>
                    <div class='errorMessage'>
                        <p>Error preparing approved report statement.</p>
                    </div>
        
                    <div class='errorButtonContainer'>
                        <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                    </div>
                </div>
            </div>
        </div>";
            exit;
        }
    } else {
        echo "<div class='errorMessageContainer1' style='display: block;'>
        <div class='errorMessageContainer'>
            <div class='subErrorMessageContainer'>
                <div class='errorMessage'>
                    <p>Error preparing approved report statement.</p>
                </div>
    
                <div class='errorButtonContainer'>
                    <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                </div>
            </div>
        </div>
    </div>";
        exit;
    }
    
    $formattedTimestamp = date("F j, Y | l g:ia", strtotime($timestamp));
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
    <link rel="stylesheet" href="../../assets/css/equip_details.css">
    
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
                        <p>NOTIFICATION</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="notification.php?id=<?php echo $userID ?>">
                                <button class="trackButton1">Back</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="subViewApproveContainer">

                    <div class="equipImageContainer">
                        <div class="subEquipImageContainer">
                        <?php if (!empty($image)): ?>
                            <img class="subEquipImageContainer" src="../../uploads/<?php echo $image; ?>" alt="">
                        <?php else: ?>
                            <img class="subEquipImageContainer" src="../../assets/img/img_placeholder.jpg" alt="">
                        <?php endif; ?>
                        </div>
                    </div>

                    <div class="report-info" style="display: block; width: 50%; margin: auto; ">
                        <p>Article: <span><?php echo $article; ?></span></p>
                        <p>Unit ID: <span><?php echo $unitID; ?></span></p>
                        <p>Property number: <span><?php echo $propertyNumber; ?></span></p>
                        <p>Account code: <span><?php echo $accountCode; ?></span></p>
                        <br>
                        <hr>
                        <br>
                        <h3>UNIT REPLACEMENT</h3>
                        <br>
                        <P>Unit cost: <span><?php echo $unitCost; ?></span></P>
                        <p>Unit specification: <span><?php echo $unitSpecs; ?></span></p>
                        <br>
                        <hr>
                        <br>
                        <h3>END USER</h3>
                        <br>
                        <P>First name: <span><?php echo $firstName; ?></span></P>
                        <P>Last name: <span><?php echo $lastName; ?></span></P>
                        <P>Designation: <span><?php echo $designation; ?></span></P>
                        <P>E-mail: <span><?php echo $email; ?></span></P>
                        <br>
                        <p><a href="user_profile.php?id=<?php echo $userID; ?>&user_id=<?php echo $user_ID; ?>"> Go to profile </a></p>
                        <br>
                        <br>
                        <p>Replacement Date: <span class="approvedDate"><?php echo $formattedTimestamp; ?></span></p>
                        <br>
                        <p style="font-style: italic;"><a href="bin.php?id=<?php echo $userID; ?>">Click here</a> to restore the unit and add it back to the available unit list</p>
                    </div>
                    
                </div>


              </div>
            </div>  
        </div>
    </div>
</div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/uploadImg.js"></script>
    <script>
            function closeErrorMessage(){
        var close1 = document.querySelector('.errorMessageContainer1');

        if(close1.style.display === 'block'){
            close1.style.display = 'none';
        } else{
            close1.style.display = 'block'
        }
    }

    </script>

</body>
</html>