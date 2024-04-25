<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";

    if (isset($_GET['user_ID'])) {
        $user_ID = $_GET['user_ID'];
    
        $query = "SELECT * FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $query = "SELECT equipment_ID, unit_ID, equipment_name FROM units WHERE user_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $units = $result->fetch_all(MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="../../assets/css/enduser_unit.css">
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
                        <p>END USER UNITS</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <button class="trackButton1" onclick="openPrintSettings()">Print <img src="../../assets/img/print.png" alt=""></button>
                            <a href="user_profile.php?id=<?php echo urlencode($userID); ?>&user_ID=<?php echo urlencode($user['user_ID']); ?>">
                                <button class="trackButton1" id="go-to-profile">Go to profile <img src="../../assets/img/person-circle.png" style="width: 1.7rem; height: 1.7rem;"></button>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="tableContainer2">
                    <div class="unitContainer1">
                        <div class="subUnitContainer1">
                            <div class="imageContainer2">
                                <div class="subImageContainer2">
                                    <?php
                                        if (!empty($user['profile_img'])) {
                                            echo '<img class="image13" src="../../uploads/' . $user['profile_img'] . '" alt="Profile Image">';
                                        } else {
                                            echo '<img class="image13" src="../../assets/img/pp_placeholder.png" alt="Mountain Placeholder">';
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="userNameContainer">
                                <label for="">End user:</label>
                                <div class="subUserNameContainer">
                                    <p><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="subUnitContainer1">
                            <div class="userNameContainer">
                                <label for="">Designation:</label>
                                <div class="subUserNameContainer">
                                    <p><?php echo $user['designation']; ?></p>
                                </div>
                            </div>

                            <div class="userNameContainer">
                                <label for="">E-mail:</label>
                                <div class="subUserNameContainer">
                                    <p><?php echo $user['email']; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="subUnitContainer1"  id="departmentContainer">
                            <div class="userNameContainer" >
                                <label for="">Department:</label>
                                <div class="subUserNameContainer">
                                    <p><?php echo $user['department']; ?></p>
                                </div>
                            </div>
                        </div>
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
                                    <th>REMARKS</th>
                                </tr>
                            </thead>
        
                            <tbody id="tblBody">
                                <?php
                                    $count = 1; 
                                    foreach ($units as $unit) {
                                        $unitID = $unit['unit_ID']; 
                                        $equipmentName = $unit['equipment_name'];
                                        $equipmentID = $unit['equipment_ID'];
                                        $formattedUnitID = 'UNIT-' . str_pad($unitID, 4, '0', STR_PAD_LEFT);

                                        $sql = "SELECT property_number, account_code, remarks FROM equipment WHERE equipment_ID = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param('i', $equipmentID);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $equipment = $result->fetch_assoc();

                                        $propertyNumber = $equipment['property_number'] ?? '';
                                        $accountCode = $equipment['account_code'] ?? '';
                                        $remarks = $equipment['remarks'] ?? '';
                                        
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>$formattedUnitID</td>";
                                        echo "<td>$equipmentName</td>";
                                        echo "<td>$propertyNumber</td>";
                                        echo "<td>$accountCode</td>";
                                        echo "<td>$remarks</td>";
                                        echo "</tr>";
                                        $count++; 
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

    <script>
        function filterTable() {
        var searchTerm = document.querySelector(".searchBar1").value.trim().toLowerCase();

        var rows = document.querySelectorAll("#tblBody tr");
        var noResultsMessage = document.querySelector(".noResultsFound");

        var found = false;

        rows.forEach(function(row) {
            var unitID = row.querySelector("td:nth-child(2)").textContent.toLowerCase(); 
            var article = row.querySelector("td:nth-child(3)").textContent.toLowerCase(); 
            var propertyNumber = row.querySelector("td:nth-child(4)").textContent.toLowerCase(); 
            var accountCode = row.querySelector("td:nth-child(5)").textContent.toLowerCase(); 
            var remarks = row.querySelector("td:nth-child(6)").textContent.toLowerCase(); 

            if (unitID.includes(searchTerm) || article.includes(searchTerm) || propertyNumber.includes(searchTerm) || accountCode.includes(searchTerm) || remarks.includes(searchTerm)) {
                row.style.display = ""; 
                found = true;
            } else {
                row.style.display = "none"; 
            }
        });

        if (found) {
            noResultsMessage.style.display = "none";
        } else {
            noResultsMessage.style.display = "block";
        }
    }

    document.querySelector(".searchBar1").addEventListener("input", filterTable);
    </script>

    <script>
        function filterTable() {
            var year = document.getElementById("yearFilter").value;
            var unitID = document.getElementById("unitIDFilter").value;
            var endUser = document.getElementById("endUserFilter").value;
            var alphabetFilter = document.getElementById("alphabetFilter").value; 
            var rows = document.querySelectorAll("#tblBody tr");
            var anyMatch = false;
            var sortedRows = Array.from(rows); 

            if (alphabetFilter === "A-Z") {
                sortedRows.sort((a, b) => {
                    return a.querySelector("td:nth-child(6)").textContent.localeCompare(b.querySelector("td:nth-child(6)").textContent);
                });
            } else if (alphabetFilter === "Z-A") {
                sortedRows.sort((a, b) => {
                    return b.querySelector("td:nth-child(6)").textContent.localeCompare(a.querySelector("td:nth-child(6)").textContent);
                });
            }

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