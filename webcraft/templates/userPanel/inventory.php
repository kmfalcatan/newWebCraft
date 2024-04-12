<?php
 include_once "../../functions/header.php";
 include_once "../../authentication/auth.php";
 
 if (isset($_POST['unitID'])) {
    $unitIDInput = $_POST['unitID'];

    $unitID = intval(substr($unitIDInput, 5));
    $sql = "SELECT * FROM units WHERE unit_ID = '$unitID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $unitDetails = array(
            'unitID' => $unitIDInput,
            'user' => $row['user'],
            'equipmentName' => $row['equipment_name']
        );
    
    $user = $row['user'];
    $userSql = "SELECT first_name, last_name, username, designation, department, email FROM users WHERE CONCAT(first_name, ' ', last_name) = '$user'";
    $userResult = $conn->query($userSql);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $unitDetails['firstName'] = $userRow['first_name'];
        $unitDetails['lastName'] = $userRow['last_name'];
        $unitDetails['userName'] = $userRow['username'];
        $unitDetails['designation'] = $userRow['designation'];
        $unitDetails['department'] = $userRow['department'];
        $unitDetails['email'] = $userRow['email'];
    }

    $equipmentName = $row['equipment_name'];
    $deploymentSql = "SELECT description, deployment, account_code, property_number, unit_value, year_received, remarks, image FROM equipment WHERE article = '$equipmentName'";
    $deploymentResult = $conn->query($deploymentSql);

    if ($deploymentResult->num_rows > 0) {
        $deploymentRow = $deploymentResult->fetch_assoc();
        $unitDetails['description'] = $deploymentRow['description'];
        $unitDetails['deployment'] = $deploymentRow['deployment'];
        $unitDetails['accountCode'] = $deploymentRow['account_code'];
        $unitDetails['propertyNumber'] = $deploymentRow['property_number'];
        $unitDetails['unitValue'] = $deploymentRow['unit_value'];
        $unitDetails['remarks'] = $deploymentRow['remarks'];
        $unitDetails['yearReleased'] = $deploymentRow['year_received'];
        $unitDetails['image'] = "../../uploads/" . $deploymentRow['image'];
    }

    $unitIssueSql = "SELECT report_issue FROM unit_report WHERE unit_ID = '$unitID'";
    $unitIssueResult = $conn->query($unitIssueSql);

    if ($unitIssueResult->num_rows > 0) {
        $unitIssueRow = $unitIssueResult->fetch_assoc();
        $unitDetails['reportIssue'] = $unitIssueRow['report_issue'];
    }

        echo json_encode($unitDetails); 
        exit;
    } else {
        echo "not_exists"; 
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
                        <p>INVENTORY</p>
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
                            <button class="trackButton1">Sort <img src="../../assets/img/sort.png" alt="" style="margin-left: 0.5rem; width: 1.4rem; height: 1.2rem;"></button>
                            
                        </div>
                    </div>
                </div>

                <div class="tableContainer2">
                    <div class="unitContainer">
                        <a href="unit_list.php?id=<?php echo $userID; ?>">
                            <button class="unitList">Go to unit list</button>
                        </a>
                    </div>

                    <div class="tableContainer">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ARTICLE</th>
                                    <th>PROPERTY NUMBER</th>
                                    <th>ACCOUNT CODE</th>
                                    <th>UNITS</th>
                                    <th>YEAR</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
        
                            <tbody id="tblBody">
                                <?php
                                    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

                                    $sql = "SELECT * FROM equipment WHERE article LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $count = 1; 
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr data-year='{$row['year_received']}'>";
                                            echo "<td>{$count}</td>";
                                            echo "<td>{$row['article']}</td>";
                                            echo "<td>{$row['property_number']}</td>";
                                            echo "<td>{$row['account_code']}</td>";
                                            echo "<td>{$row['total_unit']}</td>";
                                            echo "<td>{$row['year_received']}</td>";
                                            echo "<td class='actionContainer' style='display: flex;'>";
                                            echo "<a href='equip_other_info.php?id={$userID}&equipment_ID={$row['equipment_ID']}'>
                                                    <div class='button4'><p>View</p></div>
                                                    </a>";
                                            echo "</td>";
                                            echo "</tr>";
                                            $count++; 
                                        }
                                    } else {
                                        echo "<tr><td colspan='11'>No equipment found</td></tr>";
                                    }

                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                   </div>
                </div>
            </div>  

            <div class="trackUnitContainer" style="display: none;" id="popupContainer">
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
                                    <div class="imageContainer1">
                                        <div class="subImageContainer1">
                                            <img class="image12"  id="imageDisplay" src="" alt="Equipment Image">
                                        </div>
    
                                        <div class="equipNameContainer">
                                            <p id="equipmentNameDisplay"></p>
                                            <p id="unitIDDisplay"></p>
                                        </div>
                                    </div>
    
                                    <div class="subInfoContainer1" id="unitDetails">
                                        <div class="unitIDContainer">
                                            <div class="unitID">
                                                <p>Property number</p>
    
                                                <div class="unitInputContainer" >
                                                    <p id="propertyNumberDisplay"></p>
                                                    <!-- <p id="userDisplay"></p> -->
                                                </div>
                                            </div>
    
                                            <div class="unitID">
                                                <p>Account code</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="accountCodeDisplay"></p>
                                                    <!-- <p id="deploymentDisplay"></p> -->
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="unitIDContainer">
                                            <div class="unitID">
                                                <p>Unit value</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="unitValueDisplay"></p>
                                                </div>
                                            </div>
    
                                            <div class="unitID">
                                                <p>Year released</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="yearReleasedDisplay"></p>
                                                </div>
                                            </div>

                                            <div class="unitID">
                                                <p>Remarks</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="remarksDisplay"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="unitIDContainer">
                                            <div class="unitID" id="unitDesc">
                                                <label>Description</label>
    
                                                <div class="unitInputContainer">
                                                    <p id="descriptionDisplay"></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div>
                                    <div class="oldUserContainer">
                                        <div class="oldUserTextContainer">
                                            <p>CURRENT END USER</p>
                                        </div>
    
                                        <div class="unitIDContainer">
                                            <div class="unitID">
                                                <p>First name</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="userDisplay" style="display: none;"></p>
                                                    <p id="firstNameDisplay"></p>
                                                </div>
                                            </div>
    
                                            <div class="unitID">
                                                <p>Last name</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="lastNameDisplay"></p>
                                                </div>
                                            </div>

                                            <div class="unitID" id="username">
                                                <p>User name</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="userNameDisplay"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="unitIDContainer">
                                            <div class="unitID">
                                                <p>Designation</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="designationDisplay"></p>
                                                </div>
                                            </div>

                                            <div class="unitID">
                                                <p>Department</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="departmentDisplay"></p>
                                                </div>
                                            </div>

                                            <div class="unitID">
                                                <p>Email</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="emailDisplay"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="unitIDContainer">
                                            <div class="unitID" id="yearTransferred">
                                                <p>Year trasferred</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="oldUserContainer">
                                        <div class="oldUserTextContainer">
                                            <p>OLD END USER</p>
                                        </div>

                                        <div class="unitIDContainer">
                                            <div class="unitID">
                                                <p>First name</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>

                                            <div class="unitID">
                                                <p>Last name</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>

                                            <div class="unitID" id="username">
                                                <p>User name</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="unitIDContainer">
                                            <div class="unitID">
                                                <p>Designation</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>

                                            <div class="unitID">
                                                <p>E-mail</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>

                                            <div class="unitID" id="username">
                                                <p>Year handled</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="oldUserContainer">
                                        <div class="oldUserTextContainer">
                                            <p>UNIT HISTORY</p>
                                        </div>
    
                                        <div class="unitIDContainer">
                                            <div class="unitID">
                                                <p>Issue:</p>
    
                                                <div class="unitInputContainer">
                                                    <p id="reportIssueDisplay"></p>
                                                </div>
                                            </div>
    
                                            <div class="unitID">
                                                <p>Date retrieved:</p>
    
                                                <div class="unitInputContainer">
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="buttonContainer3">
                            <button  onclick="closePopup()" class="button5">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>