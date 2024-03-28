<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIT TRANSFER</title>

    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/report.css">
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
                    <div class="subIconContainer10">
                        <img class="subIconContainer10" src="../../assets/img/notif.png" alt="">
                    </div>
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
            
            <div class="container5">
                <div class="subContainer6">
                    <div class="headerContainer4">
                        <a href="../user panel/userEquip.php?equipment_ID=<?php echo $equipment_ID; ?>&id=<?php echo $userID; ?>"> 
                            <div class="backContainer5">
                                <img class="backContainer6" src="../assets/img/left-arrow.png" alt="">
                            </div>
                        </a>
        
                        <div class="iconContainer6">
                            <div class="subIconContainer6">
                                <img src="../assets/img/transfer-icon.png" alt="" style="width: 2.5rem; height: 2.2rem;">
                            </div>
        
                            <div class="textContainer10">
                                <p>UNIT TRANSFER</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="infoContainer90">
                        <div class="subInfoContainer9">
                            <div class="imageContainer10">
                                <div class="subImageContainer10"> 
                                    <img class="subImageContainer10" src="<?php echo $imageURL; ?>" alt="Mountain Placeholder" onerror="this.onerror=null; this.src='../assets/img/img_placeholder.jpg';">
                                </div>
                            </div>
        
                            <div class="equipNameContainer67">
                                <p><?php echo $article; ?></p>
                            </div>
                        </div>
        
                        <div class="infoContainer17">
                            <div class="subInfoContainer17">
                                <p>UNIT CUSTODIAN</p>
                            </div>
        
                            <div class="textContainer56">
                                <div class="subTextContainer56">
                                    <?php foreach ($userInfo as $info): ?>
                                        <div class="userHandler56">
                                            <p><?php echo $info['user']; ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
        
                            <div class="subInfoContainer17">
                                <p>DEPLOYMENT</p>
                            </div>
        
                            <div class="textContainer56">
                                <div class="subTextContainer56">
                                    <p><?php echo $deployment; ?></p>
                                </div>
                            </div>
        
                            <div class="subInfoContainer17">
                                <p>PROPERTY NUMBER</p>
                            </div>
        
                            <div class="textContainer56">
                                <div class="subTextContainer56">
                                    <p><?php echo $property_number; ?></p>
                                </div>
                            </div>
        
                            <div class="subInfoContainer17">
                                <p>ACCOUNT CODE</p>
                            </div>
        
                            <div class="textContainer56">
                                <div class="subTextContainer56">
                                    <p><?php echo $account_code; ?></p>
                                </div>
                            </div>
        
                            <div class="subInfoContainer17">
                                <p>DESCRIPTION</p>
                            </div>
        
                            <div class="textContainer156">
                                <div class="subTextContainer56">
                                    <p><?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <form class="buttonContainer" id="buttonContainer" action="../functions/saveTransfer.php" method="post">
                    <button style="display: block;" id="selectButton" onclick="popup()" class="button" type="button">SELECT UNIT</button>
                    
                    <input type="hidden" name="equipment_ID" value="<?php echo $equipment_ID; ?>">
                    <input type="hidden" name="user_ID" value="<?php echo $userID; ?>">
                    <input type="hidden" name="unit_ID" id="unit_ID">
                    <input type="hidden" name="reason" id="reason">
                    <input type="hidden" name="new_handler" id="new_handler">
        
        
                    <div class="unitContainer" style="display: none;">
                        <div class="subUnitContainer">
                        <?php
                                if(isset($_GET['equipment_ID'])) {
                                    $equipment_ID = $_GET['equipment_ID'];
                                
                                    $sql = "SELECT u.unit_ID, u.user 
                                            FROM units u 
                                            JOIN users usr ON u.user = usr.fullname 
                                            WHERE u.equipment_ID = ? AND usr.id = ?";
                                    $stmt = $conn->prepare($sql);
                                
                                    $stmt->bind_param("ii", $equipment_ID, $userID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                
                                    while($row = $result->fetch_assoc()) {
                                        $unit_id = $row['unit_ID'];
                                        $user = $row['user'];
                                
                                        $unitPrefix = 'UNIT';
                                        $defaultUnitID = '0000';
                                        $formattedUnitID = $unitPrefix . '-' . str_pad($unit_id, strlen($defaultUnitID), '0', STR_PAD_LEFT);
                                
                                        echo '<div class="unitAndCheckboxContainer">'; 
                                        echo '<div class="equipContainer">';
                                        echo '<div class="checkBoxContainer">';
                                        echo '<input class="checkbox" type="checkbox" data-unit-id="' . $formattedUnitID . '">';
                                        echo '</div>';
                                        echo '<div class="unitNameContainer">';
                                        echo '<h3>' . $formattedUnitID . '</h3>';
                                        echo '</div>';
                                        echo '<div class="userContainer" style="display: none";>';
                                        echo '<p>' . $user . '</p>';
                                        echo '</div>';
                                        echo '<div class="unitNameContainer1">';
                                        echo '<select  class="issue" data-unit-id="' . $formattedUnitID . '">';
                                        echo '<option value="" disabled selected>Select user</option>';
                                        $userQuery = "SELECT fullname FROM users WHERE role = 'user'";
                                        $userResult = $conn->query($userQuery);
                                        if ($userResult->num_rows > 0) {
                                            while($userRow = $userResult->fetch_assoc()) {
                                                echo '<option value="' . $userRow["fullname"] . '">' . $userRow["fullname"] . '</option>';
                                            }
                                        }
                                        echo '</select>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>'; 
                                    }
                                }
                                ?>
                                
                        </div>
        
                        <div class="buttonContainer1">
                            <button onclick="popup1()" class="button1" id="save-button" type="button">Save</button>
                        </div>
                    </div>
        
                    <div class="unitContainer1" id="unit" style="display: none;">
                        <div class="headerContainer2">
                            <p>SELECTED UNITS</p>
                        </div>
        
                        <div class="unitInfoContainer">
                            
                        </div>
                        <div class="submitContainer"  id="submitContainer">
                            <button onclick="popup1()" class="button2" type="button" id="add-more">Add more</button>
                            <button class="button2"  id="submit-button" type="submit"  onclick="submitForm()">Submit</button>
                        </div>
        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>