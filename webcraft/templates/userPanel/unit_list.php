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
                                            echo "</tr>";
                                            $count++;
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

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/filter.js"></script>
    <script src="../../assets/js/toggle.js"></script>

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