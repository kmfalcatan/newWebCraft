<?php
include_once "../../functions/header.php";
include_once "../../authentication/auth.php";

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
        $user_ID = $row['user_ID']; 
        $unitDetails = array(
            'unitID' => $unitIDInput,
            'user_ID' => $row['user_ID'],
            'equipmentName' => $row['equipment_name']
        );

        $unitID = intval(substr($unitIDInput, 5));
        $unitSql = "SELECT year_received FROM units WHERE unit_ID = ?";
        $unitStmt = $conn->prepare($unitSql);
        $unitStmt->bind_param("i", $unitID);
        $unitStmt->execute();
        $unitResult = $unitStmt->get_result();

        if ($unitResult->num_rows > 0) {
            $unitRow = $unitResult->fetch_assoc();
            $unitDetails['unitYearReceived'] = $unitRow['year_received'];
        }

        $user_ID = $row['user_ID'];
        $userSql = "SELECT first_name, middle_initial, last_name, username, designation, department, email FROM users WHERE user_ID = ?";
        $userStmt = $conn->prepare($userSql);
        $userStmt->bind_param("i", $user_ID);
        $userStmt->execute();
        $userResult = $userStmt->get_result();

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $unitDetails['firstName'] = $userRow['first_name'];
            $unitDetails['middleInitial'] = $userRow['middle_initial'];
            $unitDetails['lastName'] = $userRow['last_name'];
            $unitDetails['userName'] = $userRow['username'];
            $unitDetails['designation'] = $userRow['designation'];
            $unitDetails['department'] = $userRow['department'];
            $unitDetails['email'] = $userRow['email'];
        }

        $equipmentName = $row['equipment_name'];
        $equipmentSql = "SELECT description, account_code, property_number, unit_value, year_received, remarks, warranty_end, image FROM equipment WHERE article = ?";
        $equipmentStmt = $conn->prepare($equipmentSql);
        $equipmentStmt->bind_param("s", $equipmentName);
        $equipmentStmt->execute();
        $equipmentResult = $equipmentStmt->get_result();

        if ($equipmentResult->num_rows > 0) {
            $equipmentRow = $equipmentResult->fetch_assoc();
            $unitDetails['description'] = $equipmentRow['description'];
            $unitDetails['accountCode'] = $equipmentRow['account_code'];
            $unitDetails['propertyNumber'] = $equipmentRow['property_number'];
            $unitDetails['unitValue'] = $equipmentRow['unit_value'];
            $unitDetails['remarks'] = $equipmentRow['remarks'];
            $unitDetails['yearReceived'] = $equipmentRow['year_received'];
            $unitDetails['warrantyEnd'] = $equipmentRow['warranty_end'];
            $unitDetails['image'] = "../../uploads/" . $equipmentRow['image'];
        }
    
        $unitTransferSql = "SELECT old_end_user_first_name, old_end_user_last_name, old_end_userID, year_transfer, timestamp FROM unit_transfer WHERE unit_ID = ?";
        $unitTransferStmt = $conn->prepare($unitTransferSql);
        $unitTransferStmt->bind_param("s", $unitIDInput);
        $unitTransferStmt->execute();
        $unitTransferResult = $unitTransferStmt->get_result();

        if ($unitTransferResult->num_rows > 0) {
            $unitDetails['oldEndUserNames'] = array();

        while ($unitTransferRow = $unitTransferResult->fetch_assoc()) {
            $oldEndUser = array(
                'firstName' => $unitTransferRow['old_end_user_first_name'],
                'lastName' => $unitTransferRow['old_end_user_last_name'],
                'year_transfer' => $unitTransferRow['year_transfer'],
                'timestamp' => $unitTransferRow['timestamp']
            );

        $oldEndUserID = $unitTransferRow['old_end_userID'];
        $userSql = "SELECT middle_initial, username, email, designation, department FROM users WHERE user_ID = ?";
        $userStmt = $conn->prepare($userSql);
        $userStmt->bind_param("s", $oldEndUserID);
        $userStmt->execute();
        $userResult = $userStmt->get_result();

            if ($userResult->num_rows > 0) {
                $userRow = $userResult->fetch_assoc();
                $oldEndUser['middleInitial'] = $userRow['middle_initial'];
                $oldEndUser['username'] = $userRow['username'];
                $oldEndUser['email'] = $userRow['email'];
                $oldEndUser['designation'] = $userRow['designation'];
                $oldEndUser['department'] = $userRow['department'];
            }

            $unitDetails['oldEndUserNames'][] = $oldEndUser;
        }
    }

        $issueSql = "SELECT report_issue, timestamp FROM approved_report WHERE unit_ID = ?";
        $issueStmt = $conn->prepare($issueSql);
        $issueStmt->bind_param("s", $unitIDInput);
        $issueStmt->execute();
        $issueResult = $issueStmt->get_result();
        
        if ($issueResult->num_rows > 0) {
            $unitDetails['unitIssues'] = array();
        
            while ($issueRow = $issueResult->fetch_assoc()) {
                $unitIssue = array(
                    'reportIssue' => $issueRow['report_issue'],
                    'timestamp' => $issueRow['timestamp']
                );
                $unitDetails['unitIssues'][] = $unitIssue;
            }
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
    </div>
";
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
    <link rel="stylesheet" href="../../assets/css/tracker.css">
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

            <div class="subContainer1" id="inventoryContainer">
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>INVENTORY</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <div style="border: none;" class="trackButton">
                                <button class="trackButton" type="button" onclick="track()">Track Unit</button>
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
                            <a href="new_item.php?id=<?php echo $userID; ?>">
                            <button class="trackButton1" id="new-equip">New Item<span class="plusIcon">+</span></button>
                            </a>
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

            <div class="trackUnitContainer" id="popupContainer" style="display: none;">
                <?php include('tracker.php'); ?>
            </div>
        </div>
    </div>

    <script src="../../assets/js/a.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>