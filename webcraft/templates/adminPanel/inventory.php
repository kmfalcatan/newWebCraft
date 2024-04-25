<?php
   include_once "../../functions/header.php";
   include_once "../../authentication/auth.php";
   include_once "../../functions/get_track.php";
   
   $success_message = isset($_GET['success_message']) ? $_GET['success_message'] : '';
   $error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';
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
    <link rel="stylesheet" href="../../assets/css/tracker.css">
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

            <div class="subContainer1" id="inventoryContainer">
                <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>INVENTORY</p>
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
                            <div class="trackButton">
                                <button class="trackButton" type="button" onclick="track()" style="border: none;">Track Unit</button>
                                <form class="subTrackContainer" style="display: none;"  id="trackForm" method="post">
                                    <div class="searhUnitContainer">
                                        <p>Enter Unit ID:</p>
                                    </div>

                                    <div class="searchUnitContainer">
                                        <input type="text" class="searchBar1" id="unitID" placeholder="e.g. UNIT-0001">
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
                            <a href="new_item.php?id=<?php echo $userID; ?>">
                            <button class="trackButton1" id="new-equip">New Item<span class="plusIcon">+</span></button>
                            </a>
                            <button class="trackButton1" onclick="showFilterPopup()">Sort <img src="../../assets/img/sort.png" alt="" style="margin-left: 0.5rem; width: 1.4rem; height: 1.2rem;"></button>

                            <div class="filterPopupContainer" id="filterPopupContainer" style="display: none;">
                                <div class="filterPopupContent">
                                    <h2>UNIT FILTERS</h2>
                                    <div id="desc">
                                        <p>Use filter to find equipment</p>
                                    </div>

                                    <div class="filters">
                                        <div class="labelContainer">
                                            <p id="allFilter" onclick="resetFilters()">All</p>
                                            <p>Year</p>
                                            <p>Article</p>
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
                                                    <option value="" selected disabled>Select article</option>
                                                                                        <?php
                                                    $sql = "SELECT article FROM equipment";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' .  $row['article'] . '">' . $row['article'] . '</option>';
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
                        <a href="unit_list.php?id=<?php echo urlencode($userID); ?>">
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
                                    $sql = "SELECT * FROM equipment WHERE article LIKE ? OR description LIKE ? OR property_number LIKE ? OR account_code LIKE ? OR total_unit LIKE ? OR year_received LIKE ?";
                                    $stmt = $conn->prepare($sql);
                                    $searchPattern = "%$searchTerm%";
                                    $stmt->bind_param("ssssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern);

                                    $stmt->execute();
                                    $result = $stmt->get_result();

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
                                            echo "<a href='equip_other_info.php?id=" . urlencode($userID) . "&equipment_ID=" . urlencode($row['equipment_ID']) . "'>";
                                            echo "<div class='button4'><p>View</p></div>";
                                            echo "</a>";
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
                        <div class="noResultsFound" style="display: none;">
                            <p>No results found</p>
                        </div>
                   </div>
                </div>
            </div>  

            <div class="trackUnitContainer" id="popupContainer" style="display: none;">
                <?php include('tracker.php'); ?>
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
        var alphabet = document.getElementById("alphabetFilter").value;
        var rows = document.querySelectorAll("#tblBody tr");
        var anyMatch = false;

        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var yearCell = row.querySelector("td:nth-child(6)");
            var unitIDCell = row.querySelector("td:nth-child(2)");

            var showRow =
                (!year || year === yearCell.textContent) &&
                (!unitID || unitID === unitIDCell.textContent);

            row.style.display = showRow ? "" : "none";

            if (showRow) {
                anyMatch = true;
            }
        }

        if (alphabet === "asc") {
            rows = Array.prototype.slice.call(rows);
            rows.sort(function (a, b) {
                var articleA = a.querySelector("td:nth-child(2)").textContent.toLowerCase();
                var articleB = b.querySelector("td:nth-child(2)").textContent.toLowerCase();
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
                    var articleA = a.querySelector("td:nth-child(2)").textContent.toLowerCase();
                    var articleB = b.querySelector("td:nth-child(2)").textContent.toLowerCase();
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
        document.getElementById("alphabetFilter").addEventListener("change", filterTable);

        filterTable();

        function resetFilters() {
        document.getElementById("yearFilter").selectedIndex = 0;
        document.getElementById("unitIDFilter").selectedIndex = 0;
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