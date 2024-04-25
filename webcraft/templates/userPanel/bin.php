<?php
 include_once "../../functions/header.php";
 include_once "../../dbConfig/dbconnect.php";
 include_once "../../authentication/auth.php";

$success_message = isset($_GET['success_message']) ? $_GET['success_message'] : '';
$error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';

 $userID = isset($_GET['id']) ? $_GET['id'] : null;
    
 $sql = "SELECT ar.approved_ID, ar.user_ID, ar.unit_ID, ar.equipment_ID, ar.report_issue, ar.timestamp, e.article, u.first_name, u.last_name 
        FROM approved_report ar 
        JOIN equipment e ON ar.equipment_ID = e.equipment_ID
        JOIN users u ON ar.user_ID = u.user_ID
        WHERE ar.user_ID = '$userID'"; 
 $stmt = $conn->prepare($sql);
 $stmt->execute();
 $stmt->bind_result($approvedID, $user_ID, $unitID, $equipmentID, $reportIssue, $timestamp, $article, $firstName, $lastName);

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
    <link rel="stylesheet" href="../../assets/css/bin.css">
    <style>
    @media print {
        th:nth-child(6),
        td:nth-child(6),
        td:nth-child(7),
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
                        <p>REMOVED UNIT LIST</p>
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

                    <div class="subFilterContainer1" >
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <div class="subTrackContainer" style="display: none;">
                                <div class="searhUnitContainer">
                                    <p>Enter Unit ID:</p>
                                </div>

                                <div class="searchUnitContainer">
                                    <button onclick="track2()" class="searchBar1">Select unit:</button>
                                </div>

                                <div class="unitsContainer">
                                    <div class="subUnitsContainer" style="display: none;">
                                        <div onclick="track3()" class="units">
                                            <p>UNIT-0001</p>
                                        </div>

                                        <div onclick="track3()" class="units">
                                            <p>UNIT-0002</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="trackButton1" onclick="openPrintSettings()">Print <img src="../../assets/img/print.png" alt="" style="margin-left: 0.5rem; width: 1.2rem; height: 1.5rem;"></button>
                        </div>
                    </div>
                </div>

                <div class="tableContainer2">

                    <div class="tableContainer">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>UNIT ID</th>
                                    <th>ARTICLE</th>
                                    <th>UNIT ISSUE</th>
                                    <th>DATE REMOVED</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
        
                            <tbody id="tblBody">
                                <?php
                                    $count = 1;
                                    while ($stmt->fetch()) {

                                        $formattedTimestamp = date("F j, Y | l g:ia", strtotime($timestamp));
                                        echo "<tr>";
                                        echo "<td>$count</td>";
                                        echo "<td>$unitID</td>";
                                        echo "<td>$article</td>";
                                        echo "<td>$reportIssue</td>";
                                        echo "<td>$formattedTimestamp</td>";
                                        echo "<td class='actionContainer' style='display: flex;'>";

                                        if (strtolower($reportIssue) == "lost") {
                                            echo "<a href='approved_lost.php?id=" . urlencode($userID) . "&approved_ID=" . urlencode($approvedID) . "'><button class='button4' type='button'>View</button></a>";
                                        } else {
                                            echo "<a href='approved_for_return.php?id=" . urlencode($userID) . "&approved_ID=" . urlencode($approvedID) . "'><button class='button4' type='button'>View</button></a>";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                        $count++;
                                    }
                            
                                    if ($count == 1) {
                                        echo "<tr><td colspan='6' style='text-align: center;'>No records found</td></tr>";
                                    }
                                ?>

                                <div id="sweetalert" class="sweetalert" style="display: none;">
                                    <div class="alertModal">
                                        <div class="alertContent">
                                            <div class="alertIcon">
                                                <div class="iconBorder">
                                                    <img src="../../assets/img/alert.png" alt="">  
                                                </div>
                                            </div>
                                            <div class="alertMsg">
                                                <h2>Are you sure you want to retsore unit?</h2>
                                            </div>
                                            <div class="alertBtn" id="alertBtn">
                                                <button class="button4" type="submit" id='restore' style="width: auto;">Yes, I'm sure</button>
                                                <button class="button3" id="btn" type="button" onclick="closeModal()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                var reportIssue = row.querySelector("td:nth-child(4)").textContent.toLowerCase(); // Add reportIssue search

                if (unitID.includes(searchTerm) || article.includes(searchTerm) || reportIssue.includes(searchTerm)) { // Include reportIssue search
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