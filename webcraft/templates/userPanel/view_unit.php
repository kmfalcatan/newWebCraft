<?php
include_once "../../dbConfig/dbconnect.php";
include_once "../../functions/header.php";
include_once "../../authentication/auth.php";

function isEquipmentNew($equipment_ID, $conn) {
    $currentYear = date("Y");
    $sql = "SELECT year_received FROM equipment WHERE equipment_ID = '$equipment_ID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $yearReceived = $row['year_received'];
        return $yearReceived == $currentYear;
    }
    return false;
}

$equipment_ID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;
$userID = isset($_GET['id']) ? $_GET['id'] : null;
$sql2 = "SELECT image FROM equipment WHERE equipment_ID = '$equipment_ID'";
$sql = "SELECT * FROM units WHERE equipment_ID = '$equipment_ID'";
$result_units = $conn->query($sql);
$result_equipment = $conn->query($sql2);

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
    <link rel="icon" type="image/png" href="../../assets/img/webcraftLogo.png">
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
                    <a href="">
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
                        <p>USER LIST</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                        <button class="trackButton1">Sort <img src="../../assets/img/sort.png" alt="" style="margin-left: 0.5rem; width: 1.4rem; height: 1.2rem;"></button>
                          
                        </div>
                    </div>
                </div>

                <div class="subContainer">
                <?php
                    $sql = "SELECT * FROM units WHERE equipment_ID = '$equipment_ID' LIMIT $offset, $recordsPerPage";
                    $result_units = $conn->query($sql);

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
                        echo "<div class='unit-container'style='outline: 1px solid red;'>";
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
                        echo "<button onclick='popup1()' class='historyButton' type='button'>History</button>";
                        echo "</div>";
                        echo "</div>";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
                </div>

            <div class="buttonContainer">
                <div class="next-previous">
                    <?php
                        $prevPage = $currentPage > 1 ? $currentPage - 1 : 1;
                        echo "<a href='view_unit.php?equipment_ID=$equipment_ID&id=$userID&page=$prevPage'><button class='previousbtn'>";
                        echo "<span><img src='../assets/img/chevron-left (1).png' alt='' style='height: 1rem; width: 1rem;'></span>";
                        echo "<span>Previous</span>";
                        echo "</button></a>";
                    ?>

                    <div class="pageIndicator"><?php echo $currentPage; ?></div>

                    <?php
                        $nextPage = $currentPage + 1;
                        echo "<a href='view_unit.php?equipment_ID=$equipment_ID&id=$userID&page=$nextPage'><button class='nextbtn'>";
                        echo "<span>Next</span>";
                        echo "<span><img src='../assets/img/chevron-right.png' alt='' style='height: 1rem; width: 1rem;'></span>";
                        echo "</button></a>";
                    ?>
                </div>
            </div>

    <script src="../../assets/js/nextPrev.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    
</body>
</html>