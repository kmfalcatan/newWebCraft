<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../functions/header.php";

$success_message = isset($_GET['success_message']) ? $_GET['success_message'] : '';
$error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';

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
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">  
    <link rel="stylesheet" href="../../assets/css/filter.css">
    <style>
    @media print {
        th:nth-child(8),
        td:nth-child(8),
        td:nth-child(9),
        td:nth-child(10),
        .actionContainer button{
            display: none;
        }
    }
    </style>  
    
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
                    <a href="notification.php?id=<?php echo urlencode($userID); ?>">
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

                    <div id="messageModal" class="messageModal">
                        <div class="alertModal">
                            <div class="alertContent">
                                <div class="alertIcon">
                                    <div class="iconBorder" style="<?php echo !empty($success_message) ? 'border: 1px solid rgba(0, 128, 0, 0.69);' : 'border: 1px solid red;'; ?>">
                                        <?php if (!empty($success_message)): ?>
                                            <p>&#10004;</p>
                                        <?php else: ?>
                                            <p class="errorIcon" style="color: red; margin-top: -0.8rem;">&times;</p> 
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="alertMsg">
                                    <?php if (!empty($success_message)): ?>
                                        <div class="success-message"><?php echo $success_message; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($error_message)): ?>
                                        <div class="error-message"><?php echo $error_message; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="alertBtn1">
                                    <button class="closebtn">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <button class="trackButton1" onclick="showFilterPopup()">Sort <img src="../../assets/img/sort.png" alt="" style="margin-left: 0.5rem; width: 1.4rem; height: 1.2rem;"></button>
                            <button class="trackButton1" onclick="openPrintSettings()">Print <img src="../../assets/img/print.png" alt="" style="margin-left: 0.5rem; width: 1.2rem; height: 1.5rem;"></button>
                            <div class="filterPopupContainer" id="filterPopupContainer" style="display: none;">
                                <div class="filterPopupContent">
                                    <h2>UNIT FILTERS</h2>
                                    <div id="desc">
                                        <p>Use filter to find unit</p>
                                    </div>

                                    <div class="filters">
                                        <div class="labelContainer">
                                            <p id="allFilter" onclick="resetFilters()">All</p>
                                            <p>Year</p>
                                            <p>Unit ID</p>
                                            <p>End user</p>
                                            <p>Alphabetical</p>
                                        </div>

                                        <div class="filterOptions">
                                            <div class="year">
                                                <select name="yearFilter" id="yearFilter">
                                                    <option value="" selected disabled>Select year</option>
                                                    <?php
                                                    $sql = "SELECT DISTINCT year_received FROM equipment";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["year_received"] . '">' . $row["year_received"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="unit">
                                                <select name="unitIDFilter" id="unitIDFilter">
                                                    <option value="" selected disabled>Select unit ID</option>
                                                                                        <?php
                                                    $sql = "SELECT DISTINCT unit_ID FROM units";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                        $formatted_unit_ID = sprintf("UNIT-%04d", $row["unit_ID"]); 
                                                        echo '<option value="' . $formatted_unit_ID . '">' . $formatted_unit_ID . '</option>';
                                                    }
                                                    
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="Enduser">
                                                <select name="endUserFilter" id="endUserFilter">
                                                    <option value="" selected disabled>Select end user</option>
                                                    <?php
                                                    $sql = "SELECT DISTINCT user FROM units";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["user"] . '">' . $row["user"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="alphabet">
                                                <select name="alphabetFilter" id="alphabetFilter" onchange="filterTable()">
                                                    <option value="Alphabet" selected disabled>Alphabet</option>
                                                    <option value="asc">A-Z</option>
                                                    <option value="desc">Z-A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                <div class="buttonContainer2" id="buttonContainer2">
                                    <button class="button3" onclick="hideFilterPopup()">Close</button>
                                </div> 
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="tableContainer2">
                    <div class="unitContainer">
                        <a href="inventory.php?id=<?php echo urlencode($userID); ?>">
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
                                $sql = "SELECT user_ID, unit_ID, equipment_name, user FROM units";
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
                                            $rowsDisplayed = true;
                                        }
                                    }
                                }
                            
                            ?>
                            </tbody>
                        </table>
                        <div class="noResultsFound" style="display: none;">
                            <p>No results found</p>
                        </div>
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
                    <select name="report_reason" id="report_reason" style="width: 12rem;">
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
                            $sql = "SELECT user_ID, first_name, last_name, rank, designation FROM users WHERE role = 'user'";
                            $stmt = $conn->prepare($sql);
                            
                            if ($stmt) {
                                $stmt->execute();
                                $result = $stmt->get_result();
                            
                                while ($row = $result->fetch_assoc()) {
                                    $new_end_userID = $row['user_ID'];
                                    $firstName = $row['first_name'];
                                    $lastName = $row['last_name'];
                                    $rank = $row['rank'];
                                    $designation = $row['designation'];
                                    $userData = json_encode([$firstName, $lastName, $new_end_userID]);
                                    echo "<option value='". htmlspecialchars($userData, ENT_QUOTES, 'UTF-8') ."'>$firstName $lastName - $rank, $designation</option>";
                                }
                            
                                $stmt->close();
                            } else {
                                echo "Error retrieving user names: " . $conn->error;
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
</script>

<script>
    function filterTable() {
        var year = document.getElementById("yearFilter").value;
        var unitID = document.getElementById("unitIDFilter").value;
        var endUser = document.getElementById("endUserFilter").value;
        var alphabet = document.getElementById("alphabetFilter").value;
        var rows = document.querySelectorAll("#tblBody tr");
        var anyMatch = false;
        var sortedRows = Array.from(rows); 

        for (var i = 0; i < sortedRows.length; i++) {
            var row = sortedRows[i];
            var yearCell = row.querySelector("td:nth-child(7)");
            var unitIDCell = row.querySelector("td:nth-child(2)");
            var endUserCell = row.querySelector("td:nth-child(6)");

            var showRow =
                (!year || year === yearCell.textContent) &&
                (!unitID || unitID === unitIDCell.textContent) &&
                (!endUser || endUser === endUserCell.textContent);
            row.style.display = showRow ? "" : "none";
            if (showRow) {
                anyMatch = true;
            }
        }

        if (alphabet === "asc") {
            rows = Array.prototype.slice.call(rows);
            rows.sort(function (a, b) {
                var articleA = a.querySelector("td:nth-child(3)").textContent.toLowerCase();
                var articleB = b.querySelector("td:nth-child(3)").textContent.toLowerCase();
                return articleA.localeCompare(articleB);
            });

            var tableBody = document.getElementById("tblBody");
            tableBody.innerHTML = "";
            for (var j = 0; j < rows.length; j++) {
                tableBody.appendChild(rows[j]);
            }
            } else if (alphabet === "desc") {
                rows = Array.prototype.slice.call(rows);
                rows.sort(function (a, b) {
                    var articleA = a.querySelector("td:nth-child(3)").textContent.toLowerCase();
                    var articleB = b.querySelector("td:nth-child(3)").textContent.toLowerCase();
                    return articleB.localeCompare(articleA);
                });

                var tableBody = document.getElementById("tblBody");
                tableBody.innerHTML = "";
                for (var j = 0; j < rows.length; j++) {
                    tableBody.appendChild(rows[j]);
                }
            }

        document.getElementById("noResultsMessage").style.display = anyMatch ? "none" : "";
    }

    document.getElementById("yearFilter").addEventListener("change", filterTable);
    document.getElementById("unitIDFilter").addEventListener("change", filterTable);
    document.getElementById("endUserFilter").addEventListener("change", filterTable);
    document.getElementById("alphabetFilter").addEventListener("change", filterTable); 

    filterTable();

    function resetFilters() {
        document.getElementById("yearFilter").selectedIndex = 0;
        document.getElementById("unitIDFilter").selectedIndex = 0;
        document.getElementById("endUserFilter").selectedIndex = 0;
        document.getElementById("alphabetFilter").selectedIndex = 0;
        filterTable();
    }
</script>

<script>
    window.onload = function() {
        var modal = document.getElementById("messageModal");
        var button = document.getElementsByClassName("closebtn")[0];

        button.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        <?php if (!empty($success_message) || !empty($error_message)): ?>
            modal.style.display = "block";
        <?php endif; ?>
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