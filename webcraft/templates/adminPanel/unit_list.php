<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../functions/header.php";

if (isset($_POST['unitID'])) {
    $unitIDInput = $_POST['unitID'];

    $unitID = intval(substr($unitIDInput, 5));

    $sql = "SELECT * FROM units WHERE unit_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $unitID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $unitDetails = array(
            'unitID' => $unitIDInput,
            'user' => $row['user'],
            'equipmentName' => $row['equipment_name']
        );

        $equipmentName = $row['equipment_name'];

        $deploymentSql = "SELECT deployment, account_code, property_number, image FROM equipment WHERE article = ?";
        $deploymentStmt = $conn->prepare($deploymentSql);
        $deploymentStmt->bind_param("s", $equipmentName);
        $deploymentStmt->execute();
        $deploymentResult = $deploymentStmt->get_result();

        if ($deploymentResult->num_rows > 0) {
            $deploymentRow = $deploymentResult->fetch_assoc();
            $unitDetails['deployment'] = $deploymentRow['deployment'];
            $unitDetails['accountCode'] = $deploymentRow['account_code'];
            $unitDetails['propertyNumber'] = $deploymentRow['property_number'];
            $unitDetails['image'] = "../../uploads/" . $deploymentRow['image'];
        }

        echo json_encode($unitDetails);
        exit;
    } else {
        echo "<div class='errorMessageContainer1' style='display: block;'>
        <div class='errorMessageContainer'>
            <div class='subErrorMessageContainer'>
                <div class='errorMessage'>
                    <p>Not exits.</p>
                </div>
    
                <div class='errorButtonContainer'>
                    <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                </div>
            </div>
        </div>
    </div>";
        exit;
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">  
    <link rel="stylesheet" href="../../assets/css/filter.css">  
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
                    <a href="notification.php?id=<?php echo $userID; ?>">
                    <div class="subIconContainer10">
                        <img class="subIconContainer10" src="../../assets/img/notif.png" alt="">
                    </div>
                    </a>
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

            <div class="subContainer1">
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>UNIT LIST</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <div class="trackButton">
                                <button class="trackButton" onclick="track()">Track Unit</button>
                                <form class="subTrackContainer" style="display: none;"  id="trackForm" method="post">
                                    <div class="searhUnitContainer">
                                        <p>Enter Unit ID:</p>
                                    </div>

                                    <div class="searchUnitContainer">
                                        <input type="text" class="searchBar1" id="unitID">
                                    </div>

                                    <div class="buttonContainer2">
                                        <div onclick="track()" class="button3">
                                            <p>Cancel</p>
                                        </div>

                                        <div class="button4" onclick="openPopup()">
                                            <p>Track</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <button class="trackButton1">Transfer unit</button>
                            <button class="trackButton1" onclick="showFilterPopup()">Sort <img src="../../assets/img/sort.png" alt="" style="margin-left: 0.5rem; width: 1.4rem; height: 1.2rem;"></button>
                           
                            <div class="filterPopupContainer" id="filterPopupContainer" style="display: none;">
                            <div class="filterPopupContent">
                                <h2>UNIT FILTERS</h2>
                                <div class="desc">
                                    <p>User filters to find units.</p>
                                </div>

                                <div class="filters">
                                    <div class="yearContainer">
                                        <label for="year">Year:</label>
                                        <select class="year" name="unit_issue">
                                            <option value="" disabled selected>Select year</option>
                                            <?php
                                                $yearQuery = "SELECT DISTINCT year_received FROM equipment";
                                            
                                                $userResult = $conn->query($yearQuery);
                                                
                                                if ($userResult->num_rows > 0) {
                                                    while($yearRow = $userResult->fetch_assoc()) {
                                                        echo '<option value="' . $yearRow["year_received"] . '">' . $yearRow["year_received"] . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="articleContainer">
                                        <label for="article">Article:</label>
                                        <select class="article" name="unit_issue">
                                            <option value="" disabled selected>Select article</option>
                                            <?php
                                                $articleQuery = "SELECT DISTINCT article FROM equipment";
                                            
                                                $articleResult = $conn->query($articleQuery);
                                                if ($articleResult->num_rows > 0) {
                                                    while($articleRow = $articleResult->fetch_assoc()) {
                                                        if (!empty($articleRow["article"])) {
                                                            echo '<option value="' . $articleRow["article"] . '">' . $articleRow["article"] . '</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="custodianContainer">
                                        <label for="custodian">Custodian:</label>
                                        <select class="custodian" name="unit_issue">
                                            <option value="" disabled selected>Select custodian</option>
                                            <?php
                                                $userQuery = "SELECT DISTINCT user FROM units";
                                                $userResult = $conn->query($userQuery);
                                                
                                                if ($userResult->num_rows > 0) {
                                                    while($userRow = $userResult->fetch_assoc()) {
                                                        if (!empty($userRow["user"])) {
                                                            echo '<option value="' . $userRow["user"] . '">' . $userRow["user"] . '</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="buttonContainer2">
                                    <button  class="button4" id="filterButton" onclick="hideFilterPopup()">Filter</button>
                                    <button class="button3" onclick="hideFilterPopup()">Close</button>
                                </div> 
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="tableContainer2">
                    <div class="unitContainer">
                        <a href="inventory.php?id=<?php echo $userID; ?>">
                            <button class="unitList">Go to inventory</button>
                        </a>
                    </div>

                    <div class="tableContainer">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>UNIT ID</th>
                                    <th>ARTICLE</th>
                                    <th>PROPERTY NUMBER</th>
                                    <th>ACCOUNT CODE</th>
                                    <th>END USER</th>
                                    <th>YEAR</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
        
                            <tbody id="tblBody">
                            <?php
                                $sql = "SELECT unit_ID, equipment_name, user FROM units";
                                $result = mysqli_query($conn, $sql);
                                
                                if ($result) {
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $equipmentName = $row['equipment_name'];
                                
                                        $sqlEquipment = "SELECT property_number, account_code, year_received FROM equipment WHERE article = ?";
                                        $stmtEquipment = $conn->prepare($sqlEquipment);
                                        $stmtEquipment->bind_param("s", $equipmentName);
                                        $stmtEquipment->execute();
                                        $resultEquipment = $stmtEquipment->get_result();
                                
                                        $formattedUnitID = '';
                                
                                        if ($resultEquipment && $equipmentRow = $resultEquipment->fetch_assoc()) {
                                            $unitPrefix = 'UNIT';
                                            $defaultUnitID = '0000';
                                            $unitID = $row['unit_ID'];
                                            $formattedUnitID = $unitPrefix . '-' . str_pad($unitID, strlen($defaultUnitID), '0', STR_PAD_LEFT);
                                
                                            echo "<tr>";
                                            echo "<td>{$count}</td>";
                                            echo "<td style='font-weight: bold;'>" . $formattedUnitID . "</td>";
                                            echo "<td>" . $row['equipment_name'] . "</td>";
                                            echo "<td>" . $equipmentRow['property_number'] . "</td>";
                                            echo "<td>" . $equipmentRow['account_code'] . "</td>";
                                            echo "<td>" . $row['user'] . "</td>";
                                            echo "<td>" . $equipmentRow['year_received'] . "</td>";
                                            echo "<td class='actionContainer' style='display: flex;'>";
                                            echo "<button class='button4' onclick='openModal1($unitID)'>Transfer unit</button>";
                                            echo "<button class='button4'  id='red-btn' onclick='openModal($unitID)'>Remove</button>";
                                            echo "</td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                   </div>
                </div>
            </div>  
                                          
        </div>
    </div>

    <div id="reportModal" class="modal">
        <div class="modal-content">
            <h3>REPORT UNIT</h3>
            <div class="reportform">
                <div class="unitIssue">
                    <label for="report_reason">Unit issue</label>
                    <select name="report_reason" id="report_reason">
                        <option value="" selected disabled>Select</option>
                        <option value="Lost">Lost</option>
                        <option value="For return">For return</option>
                    </select>
                </div>
                <br>
                <input type="hidden" id="unitID">
                <div class="buttonContainer2">
                    <button class="button4" onclick="reportUnit(document.getElementById('unitID').value)">Continue</button>
                    <button class="button3" type="button" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div id="transferModal" class="modal">
        <div class="modal-content1">
            <h3>TRANSFER UNIT</h3>
            <div class="reportform">
                <div class="enduser">
                    <label for="report_reason">To whom you want to transfer this unit?</label>
                    <select name="report_reason" id="selected_user">
                        <option value="" selected disabled>Select</option>
                        <?php
                            $sql = "SELECT user_ID, first_name, last_name FROM users WHERE role = 'user'";
                            $stmt = $conn->prepare($sql);
                    
                            if ($stmt) {
                                $stmt->execute();
                                $result = $stmt->get_result();
                    
                                while ($row = $result->fetch_assoc()) {
                                    $new_end_userID = $row['user_ID'];
                                    $firstName = $row['first_name'];
                                    $lastName = $row['last_name'];
                                    $userData = json_encode([$firstName, $lastName, $new_end_userID]);
                                    echo "<option value='". htmlspecialchars($userData, ENT_QUOTES, 'UTF-8') ."'>$firstName $lastName</option>";
                                }
                    
                                $stmt->close();
                            } else {
                                echo "<div class='errorMessageContainer1' style='display: block;'>
                                <div class='errorMessageContainer'>
                                    <div class='subErrorMessageContainer'>
                                        <div class='errorMessage'>
                                            <p>Error retrieving user names: t.</p>
                                        </div>
                            
                                        <div class='errorButtonContainer'>
                                            <button onclick='closeErrorMessage()' class='errorButton'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                " . $conn->error;
                            }
                        ?>
                    </select>
                </div>
                <br>
                <input type="hidden" id="unitID">
                <div class="buttonContainer2">
                    <button class="button4" onclick="transferUnit(document.getElementById('unitID').value)">Continue</button>
                    <button class="button3" type="button" onclick="closeModal1()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/filter.js"></script>
    <script src="../../assets/js/toggle.js"></script>

    <script>
    function reportUnit(unitID) {
        var reportReason = document.getElementById('report_reason').value;
        
        var url;
        if (reportReason === "Lost") {
            url = 'remove_lost.php?id=<?php echo $userID; ?>&unitID=' + unitID + '&reportReason=' + reportReason;
        } else if (reportReason === "For return") {
            url = 'remove_for_return.php?id=<?php echo $userID; ?>&unitID=' + unitID + '&reportReason=' + reportReason;
        } else {
            alert("Please select a valid report reason.");
            return; 
        }

        window.location.href = url;
    }

    function openModal(unitID) {
        document.getElementById('unitID').value = unitID;
        
        var modal = document.getElementById("reportModal");
        modal.style.display = "block";
        setTimeout(function() {
            modal.style.opacity = 1;
        }, 10);
    }

    function closeModal() {
        var modal = document.getElementById("reportModal");
        modal.style.opacity = 0;
        setTimeout(function() {
            modal.style.display = "none";
        }, 300);
    }
</script>

<script>
    function transferUnit(unitID) {
        var selectedUser = document.getElementById('selected_user').value;
        if (!selectedUser) {
            alert("Please select a user to transfer to.");
            return;
        }
        var userData = JSON.parse(selectedUser);
        var new_end_userID = userData[2];
        var url = 'unit_transfer.php?id=<?php echo $userID; ?>&userID=' + new_end_userID + '&unitID=' + unitID + '&selectedUser=' + encodeURIComponent(selectedUser);
        window.location.href = url;
    }

    function openModal1(unitID) {
        document.getElementById('unitID').value = unitID;
        var modal = document.getElementById("transferModal");
        modal.style.display = "block";
        setTimeout(function() { modal.style.opacity = 1; }, 10);
    }

    function closeModal1() {
        var modal = document.getElementById("transferModal");
        modal.style.opacity = 0;
        setTimeout(function() { modal.style.display = "none"; }, 300);
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
</body>
</html>