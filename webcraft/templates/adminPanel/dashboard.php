<?php
    include_once "../../dbConfig/dbconnect.php";
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";

    $sql = "SELECT COUNT(*) AS total_equipment FROM equipment";
    $totalEquipment = 0;
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($totalEquipment);
        $stmt->fetch();

        $stmt->close();
    }

    $formattedCount = "";

    if ($totalEquipment < 10) {
        $formattedCount = "0" . $totalEquipment;
    } else {
        $formattedCount = number_format($totalEquipment);
    }

    $sql = "SELECT COUNT(*) AS total_unit FROM units";
    $totalUnit = 0;
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($totalUnit);
        $stmt->fetch();

        $stmt->close();
    }

    $formattedUnitCount = "";

    if ($totalUnit < 10) {
        $formattedUnitCount = "0" . $totalUnit;
    } else {
        $formattedUnitCount = number_format($totalUnit);
    }

    $sql = "SELECT COUNT(*) AS total_removed_units FROM approved_report";
    $totalRemovedUnits = 0;
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($totalRemovedUnits);
        $stmt->fetch();

        $stmt->close();
    }

    $formattedRemovedUnitCount = "";

    if ($totalRemovedUnits < 10) {
        $formattedRemovedUnitCount = "0" . $totalRemovedUnits;
    } else {
        $formattedRemovedUnitCount = number_format($totalRemovedUnits);
    }

    $sql = "SELECT COUNT(*) AS total_lost FROM approved_report WHERE report_issue = 'lost' ";
    $totalLost = 0;
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($totalLost);
        $stmt->fetch();

        $stmt->close();
    }

    $formattedLostCount = "";

    if ($totalLost < 10) {
        $formattedLostCount = "0" . $totalLost;
    } else {
        $formattedLostCount = number_format($totalLost);
    }

    $sql = "SELECT COUNT(*) AS total_for_return FROM approved_report WHERE report_issue = 'for return' ";
    $totalForReturn = 0;
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($totalForReturn);
        $stmt->fetch();

        $stmt->close();
    }

    $formattedForReturnCount = "";

    if ($totalForReturn < 10) {
        $formattedForReturnCount = "0" . $totalForReturn;
    } else {
        $formattedForReturnCount = number_format($totalForReturn);
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
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
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

            <div class="subContainer1" id=""> 
                <div class="subContainer3">
                    <div class="dashboardContainer">
                        <div class="textContainer">
                            <p id="headerText">S.Y.  2023-2024 SECOND SEMESTER</p>
                            <button class="edit-icon" onclick="enableEditMode()">Edit</button>
                        </div>

                        <div class="equipSummaryContainer">
                            <div class="textContainer1">
                                <p>EQUIPMENT SUMMARY</p>
                            </div>

                            <div class="equipmentContainer">
                                <div class="equipmentContainer2">
                                    <div class="equipmentContainer3">
                                    <?php
                                        $sql = "SELECT article, total_unit, image FROM equipment";
                                        $stmt = $conn->prepare($sql);

                                        if ($stmt) {
                                            $stmt->execute();
                                            $stmt->bind_result($article, $totalUnit, $image);


                                            while ($stmt->fetch()) {
                                                echo '<div class="equipmentSummary">';
                                                echo "<div class='imageContainer5'>";
                                                $image = '../../uploads/' . ($image ? $image : 'img_placeholder.jpg');
                                                if (!file_exists($image)) {
                                                    $image = '../../assets/img/img_placeholder.jpg';
                                                }
                                                echo "<img src='" . $image . "' alt=''>";
                                                echo "</div>";
                                                echo '<div class="equipment-name">' . $article . '</div>';
                                                echo '<div class="total-equipment"><h1>' . $totalUnit . '</h1></div>';
                                                echo '</div>';
                                            }

                                            $stmt->close();
                                        } else {
                                            echo "Error: Unable to retrieve data from the equipment table.";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>

                            <div class="textContainer1">
                                <p>UNIT REMOVED</p>
                            </div>

                            <div class="subEquipSummaryContainer">
                                <div class="summaryContainer1">
                                    <div class="subSummaryContainer1" id="subSummaryContainer1">
                                        <div class="subTotalUnitRemove">
                                            <p>Total</p>
                                        </div>

                                        <div class="totalUnitRemove">
                                            <p class="totalRemoved"><?php echo $formattedRemovedUnitCount; ?></p>
                                        </div>
                                    </div>

                                    <div class="subSummaryContainer1" id="subSummaryContainer2">
                                        <div class="totalUnitRemove">
                                            <p><?php echo $formattedLostCount; ?></p>
                                        </div>

                                        <div class="subTotalUnitRemove">
                                            <p>Lost</p>
                                        </div>
                                    </div>
                                    
                                    <div class="subSummaryContainer1" id="subSummaryContainer2">
                                        <div class="totalUnitRemove">
                                            <p><?php echo $formattedForReturnCount; ?></p>
                                        </div>
                                        
                                        <div class="subTotalUnitRemove">
                                            <p>For return</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="textContainer1">
                                <p>END USERS</p>
                            </div>

                            <div class="unitTableContainer" id="unitTableContainer">
                                <div class="tableContainer">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>END USER</th>
                                                <th>RANK</th>
                                                <th>DESIGNATION</th>
                                                <th>TOTAL EQUIPMENT</th>
                                                <th>TOTAL UNITS</th>
                                            </tr>
                                        </thead>
                    
                                        <tbody id="tblBody">
                                        <?php
                                        $sql = "SELECT u.user_ID, u.profile_img, u.first_name, u.middle_initial, u.last_name, u.rank, u.designation, COUNT(t.unit_ID) AS total_units, COUNT(DISTINCT t.equipment_ID) AS total_equipment
                                                FROM users u
                                                LEFT JOIN units t ON u.user_ID = t.user_ID
                                                WHERE u.role = 'user'
                                                GROUP BY u.user_ID, u.profile_img, u.first_name, u.middle_initial, u.last_name, u.designation";

                                        $stmt = $conn->prepare($sql);

                                        if ($stmt) {
                                            $stmt->execute();
                                            $stmt->bind_result($user_ID, $profile_img, $firstName, $middleInitial, $lastName, $rank, $designation, $total_equipment, $total_units);

                                            echo "<tbody id='tblBody'>";

                                        while ($stmt->fetch()) {
                                            echo "<tr>";
                                            echo "<td class='endUser'>";
                                            echo "<div class='profileImg'>";
                                            $profile_image_path = '../../uploads/' . ($profile_img ? $profile_img : 'pp_placeholder.png');
                                            if (!file_exists($profile_image_path)) {
                                                $profile_image_path = '../../assets/img/pp_placeholder.png';
                                            }
                                            echo "<img src='" . $profile_image_path . "' alt=''>";
                                            echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                            echo "<p>" . $firstName . " " . $middleInitial . ". " . $lastName . "</p>";
                                            echo "</td>";
                                            echo "<td>" . $rank . "</td>";
                                            echo "<td>" . $designation . "</td>";
                                            echo "<td>" . $total_units . "</td>";
                                            echo "<td>" . $total_equipment . "</td>";
                                            echo "</tr>";
                                        }

                                                echo "</tbody>";

                                                $stmt->close();
                                            } else {
                                                echo "Error: Unable to prepare statement.";
                                            }
                                        ?>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                     </div>

                    <div class="dashboardContainer">
                        <div class="equip-unit">
                            <div class="textContainer1" id="textContainer1">
                                <p>TOTAL OF EQUIPMENT</p>
                            </div>
    
                            <div class="totalUnitsContainer">
                                <div class="subTotalUnitsContainer">
                                    <div class="numberContainer">
                                        <p id=""><?php echo $formattedCount; ?></p>
                                    </div>
    
                                    <div class="linkContainer">
                                        <p> <button id="btn2">Click here</button> to view total units</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="textContainer1" id="yearlyEquipment">
                            <p>EQUIPMENT BY YEAR</p>
                        </div>

                        <div class="unitTableContainer" id="unitTableContainer1">
                            <div class="tableContainer">
                            <?php
                                $sql = "SELECT  year_received FROM equipment ORDER BY year_received DESC";
                                $stmt = $conn->prepare($sql);
                                if ($stmt) {
                                    $stmt->execute();
                                    $stmt->bind_result($year_received);
                                    
                                    $uniqueYears = array();

                                    while ($stmt->fetch()) {
                                        if (!in_array($year_received, $uniqueYears)) {
                                            $uniqueYears[] = $year_received;
                                        }
                                    }

                                    $stmt->close();

                                    echo "<table>
                                            <thead>
                                                <tr class='byYear'>
                                                    <th>YEAR</th>
                                                    <th>TOTAL EQUIPMENT</th>
                                                    <th>TOTAL UNITS</th>
                                                </tr>
                                            </thead>
                                            <tbody>";

                                foreach ($uniqueYears as $year) {
                                    $sql_equipment = "SELECT COUNT(*) AS total_equipment FROM equipment WHERE year_received = ?";
                                    $stmt_equipment = $conn->prepare($sql_equipment);
                                    if ($stmt_equipment) {
                                        $stmt_equipment->bind_param("s", $year);
                                        $stmt_equipment->execute();
                                        $stmt_equipment->bind_result($total_equipment);
                                        $stmt_equipment->fetch();
                                        $stmt_equipment->close();
                                    } else {
                                        echo "Error: Unable to prepare statement.";
                                        exit(); 
                                    }

                                $sql_units = "SELECT COUNT(*)AS total_units 
                                            FROM units 
                                            WHERE equipment_ID IN (SELECT equipment_ID FROM equipment WHERE year_received = ?)";
                                $stmt_units = $conn->prepare($sql_units);
                                if ($stmt_units) {
                                    $stmt_units->bind_param("s", $year);
                                    $stmt_units->execute();
                                    $stmt_units->bind_result($total_units);
                                    $stmt_units->fetch();
                                    $stmt_units->close();
                                } else {
                                    echo "Error: Unable to prepare statement.";
                                    exit(); 
                                }

                                        echo "<tr>";
                                        echo "<td>" . $year . "</td>";
                                        echo "<td>" . $total_equipment . "</td>";
                                        echo "<td>" . ($total_units ? $total_units : 0) . "</td>"; 
                                        echo "</tr>";
                                    }

                                    echo "</tbody>
                                        </table>";
                                } else {
                                    echo "Error: Unable to prepare statement.";
                                }

                                $conn->close();
                            ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/toggle.js"></script>

    <script>
        let originalContent;

        function loadEditContent() {
            originalContent = document.querySelector('.equip-unit').innerHTML;

            document.querySelector('.equip-unit').innerHTML = `
                <div class="textContainer1" id="textContainer1">
                    <p>TOTAL OF UNITS</p>
                </div>

                <div class="totalUnitsContainer">
                    <div class="subTotalUnitsContainer">
                        <div class="numberContainer">
                        <p id=""><?php echo $formattedUnitCount; ?></p>
                        </div>

                        <div class="linkContainer">
                            <p> <button type="button" onclick="closeEditContent()">Click here</button> to view total equipments</p>
                        </div>
                    </div>
                </div>`;
        }

        function closeEditContent() {
            document.querySelector('.equip-unit').innerHTML = originalContent;
        }

        document.getElementById('btn2').addEventListener('click', loadEditContent);
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