<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../functions/header.php";
include_once "../../authentication/auth.php";

function isEquipmentNew($equipment_ID, $conn) {
    $currentYear = date("Y");
    $sql = "SELECT year_received FROM equipment WHERE equipment_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $equipment_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $yearReceived = $row['year_received'];
        return $yearReceived == $currentYear;
    }
    return false;
}

$equipment_ID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;
$userID = isset($_GET['id']) ? $_GET['id'] : null;
$sql2 = "SELECT image FROM equipment WHERE equipment_ID = ?";
$sql = "SELECT * FROM units WHERE equipment_ID = ?";
$stmt_units = $conn->prepare($sql);
$stmt_units->bind_param("s", $equipment_ID);
$stmt_units->execute();
$result_units = $stmt_units->get_result();

$stmt_equipment = $conn->prepare($sql2);
$stmt_equipment->bind_param("s", $equipment_ID);
$stmt_equipment->execute();
$result_equipment = $stmt_equipment->get_result();

if ($result_equipment->num_rows > 0) {
    $row = $result_equipment->fetch_assoc();
    $imageFilename = $row['image'];
    $imageURL = "../../uploads/" . $imageFilename;
}

$recordsPerPage = 9;

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $recordsPerPage;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/view_unit.css">

    <style>
        .statusContainer1.new {
            background-color: green;
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
                        <p>EQUIPMENT UNIT</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <a href="../userPanel/equip_other_info.php?id=<?php echo urlencode($userID); ?>&equipment_ID=<?php echo urlencode($equipment_ID); ?>">
                                <button class="trackButton1">Back</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="subContainer">
                <?php
                    $sql = "SELECT * FROM units WHERE equipment_ID = ?";
                    $stmt_units = $conn->prepare($sql);
                    $stmt_units->bind_param("s", $equipment_ID);
                    $stmt_units->execute();
                    $result_units = $stmt_units->get_result();
                    
                    while ($row1 = $result_units->fetch_assoc()) {
                        $equipment_name = $row1['equipment_name'];
                        $unit_ID = $row1['unit_ID'];
                        $user = $row1['user'];
                        $isNew = isEquipmentNew($equipment_ID, $conn);
                    
                        $unitPrefix = 'UNIT';
                        $defaultUnitID = '0000';
                        $unitID = $unitPrefix . '-' . str_pad($unit_ID, strlen($defaultUnitID), '0', STR_PAD_LEFT);
                        
                        echo "<div class='equipContainer' >";
                        echo "<div class='subEquipContainer' >";
                        echo "<div class='unitImgContainer' >";
                        echo "<img class='image1' src='$imageURL' alt=''>";
                        echo "</div>";
                        echo "<div class='unit-container'>";
                        echo "<div class='subUnitContainer'>";
                        echo "<div class='statusContainer1" . ($isNew ? " new" : "") . "'>";
                        echo "<p class='status1'>" . ($isNew ? "NEW" : "OLD") . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='subUnitContainer1'>";
                        echo "<p class='text'><strong>$equipment_name</strong></p>";
                        echo "</div>";
                        echo "<div class='subUnitContainer1'>";
                        echo "<p  class='text'>$unitID</p>";
                        echo "</div>";
                        echo "<div class='subUnitContainer1'>";
                        echo "<p  class='text'>$user</p>";
                        echo "</div>";

                        echo "<div class='subUnitContainer'>";
                        echo "<div class='statusContainer2'>";
                        echo "<button class='historyButton' type='button' onclick='openModal(\"$unitID\")'>History</button>";
                        echo "</div>";
                        echo "</div>";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
                <div class="noResultsFound" style="display: none;">
                    <p>No results found</p>
                </div>

                </div>
            </div>

            <div id="reportModal" class="modal" >
                <div class="modal-content">
                    <h3>UNIT HISTORY</h3>
                    <div class="reportform" >
                        <div class="unitIssue">
                            <label for="report_reason">Unit issue</label>
                            <p id="report_reason"></p>
                        </div>
                        <div class="unitIssue">
                            <label for="report_reason">Date</label>
                            <p id="date_restored"></p>
                        </div>
                        <br>
                        <div class="buttonContainer2">
                            <button class="button3" type="button" onclick="closeModal()">Close</button>
                        </div>
                    </div>
                </div>
            </div>

    <script src="../../assets/js/sidebar.js"></script>
    
    <script>
    function formatDate(date) {
        const monthNames = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"];
        const day = ("0" + date.getDate()).slice(-2);
        const monthIndex = date.getMonth();
        const year = date.getFullYear();

        return `${monthNames[monthIndex]} ${day}, ${year}`;
    }

        function openModal(unitID) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var response = JSON.parse(this.responseText);

                    var buttonContainer = document.getElementById("buttonContainer");
                    
                    if (response && response.report_issue && response.timestamp) {
                        var report_issue = response.report_issue;
                        var timestamp = new Date(response.timestamp);
                        
                        document.getElementById("report_reason").innerHTML = report_issue;
                        document.getElementById("date_restored").innerHTML = formatDate(timestamp);

                        if (buttonContainer) buttonContainer.style.display = 'block';
                    } else {

                        document.getElementById("report_reason").innerHTML = "No result found";
                        document.getElementById("date_restored").innerHTML = "";

                        if (buttonContainer) buttonContainer.style.display = 'none';
                    }
                }
            };
            xhttp.open("GET", "../../functions/get_report.php?unitID=" + unitID, true);
            xhttp.send();

            var modal = document.getElementById("reportModal");
            modal.style.display = "block";
            setTimeout(function () {
                modal.style.opacity = 1;
            }, 10);
        }
    function closeModal() {
        var modal = document.getElementById("reportModal");
        modal.style.opacity = 0;
        setTimeout(function () {
            modal.style.display = "none";
        }, 300);
    }
    </script>

<script>
    function filterUnits() {
        var searchTerm = document.querySelector(".searchBar1").value.trim().toLowerCase();
        var units = document.querySelectorAll(".equipContainer");
        var noResultsMessage = document.querySelector(".noResultsFound");
        var found = false;

        units.forEach(function(unit) {
            var equipmentName = unit.querySelector(".subUnitContainer1:nth-child(2) .text").textContent.toLowerCase();
            var unitID = unit.querySelector(".subUnitContainer1:nth-child(3) .text").textContent.toLowerCase();
            var user = unit.querySelector(".subUnitContainer1:nth-child(4) .text").textContent.toLowerCase();

            if (equipmentName.includes(searchTerm) || unitID.includes(searchTerm) || user.includes(searchTerm)) {
                unit.style.display = ""; 
                found = true;
            } else {
                unit.style.display = "none"; 
            }
        });

        if (found) {
            noResultsMessage.style.display = "none";
        } else {
            noResultsMessage.style.display = "block";
        }
    }

    document.querySelector(".searchBar1").addEventListener("input", filterUnits);
</script>


<script src="../../assets/js/nextPrev.js"></script>
<script src="../../assets/js/sidebar.js"></script>
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