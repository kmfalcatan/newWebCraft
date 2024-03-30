<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";

  
if(isset($_GET['id'])) {
    $userID = $_GET['id'];

    $query = "SELECT first_name, last_name, designation, email, department FROM users WHERE user_ID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }

    $query = "SELECT unit_ID, equipment_name FROM units WHERE user = CONCAT(?, ' ', ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $user['first_name'], $user['last_name']);
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
    <title>Document</title>

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
                        <p>END USER UNITS</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <button class="trackButton1">Sort <img src="../../assets/img/sort.png" alt=""></button>
                            <button class="trackButton1">Print <img src="../../assets/img/print.png" alt=""></button>
                            
                            <!-- <button class="trackButton1">Report</button> -->
                        </div>
                    </div>
                </div>

                <div class="tableContainer2">
                    <div class="unitContainer1">
                        <div class="subUnitContainer1" id="subUnitContainer1">
                            <div class="imageContainer2">
                                <div class="subImageContainer2">
                                    <?php
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="subUnitContainer1" >
                            <div class="userNameContainer">
                                <label for="">End user:</label>
                                <div class="subUserNameContainer">
                                    <p> <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p>
                                </div>
                            </div>

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

                            <div class="userNameContainer">
                                <label for="">department:</label>
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
                                    <th>ACTION</th>
                                </tr>
                            </thead>
        
                            <tbody id="tblBody">
                            <?php
                                $count = 1; 
                                foreach ($units as $unit) {
                                    $unitID = $unit['unit_ID']; 
                                    $equipmentName = $unit['equipment_name'];
                                    $formattedUnitID = 'UNIT-' . str_pad($unitID, 4, '0', STR_PAD_LEFT);

                                    $query = "SELECT equipment_ID, property_number, account_code FROM equipment WHERE article = ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param('s', $equipmentName);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $equipment = $result->fetch_assoc();

                                    $propertyNumber = $equipment['property_number'] ?? '';
                                    $accountCode = $equipment['account_code'] ?? '';
                                    $equipmentID = $equipment['equipment_ID'] ?? '';

                                    echo "<tr>";
                                    echo "<td>{$count}</td>";
                                    echo "<td>$formattedUnitID</td>";
                                    echo "<td>$equipmentName</td>";
                                    echo "<td>$propertyNumber</td>";
                                    echo "<td>$accountCode</td>";
                                    echo "<td class='actionContainer' style='display: flex;'>";
                                    echo "   <button class='button4' onclick='openModal($unitID)'>Report</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $count++; 
                                }
                            ?>

                            </tbody>
                        </table>
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
                    <select name="report_reason" id="report_reason">
                        <option value="" selected disabled>Select</option>
                        <option value="Lost">Lost</option>
                        <option value="For return">For return</option>
                    </select>
                </div>
                <br>
                <input type="hidden" id="unitID">
                <div class="buttonContainer2">
                    <button class="button4" onclick="reportUnit(document.getElementById('unitID').value)">Report</button>
                    <button class="button3" type="button" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

<script> 
    function openModal() {
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
    function reportUnit(unitID) {
        var reportReason = document.getElementById('report_reason').value;
        
        var url = 'a.php?id=<?php echo $userID; ?>&unitID=' + unitID + '&reportReason=' + reportReason;
        
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


</body>
</html>
