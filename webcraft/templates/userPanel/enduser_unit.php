<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    
        $query = "SELECT * FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $query = "SELECT unit_ID, equipment_name FROM units WHERE user = CONCAT(?, ' ', ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $user['first_name'], $user['last_name']);
        $stmt->execute();
        $result = $stmt->get_result();
        $units = $result->fetch_all(MYSQLI_ASSOC);

        $query = "SELECT property_number, account_code FROM equipment WHERE article = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $equipmentName);
        $stmt->execute();
        $result = $stmt->get_result();

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
                            <a href="user_profile.php?id=<?php echo $userID; ?>&user_id=<?php echo $user['user_ID']; ?>">
                                <button class="trackButton1" id="go-to-profile">Go to profile <img src="../../assets/img/person-circle.png" style="width: 1.7rem; height: 1.7rem;"></button>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="tableContainer2">
                    <div class="unitContainer1">
                        <div class="subUnitContainer1" id="subUnitContainer1">
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
                        </div>

                        <div class="subUnitContainer1" >
                            <div class="userNameContainer">
                                <label for="">End user:</label>
                                <div class="subUserNameContainer">
                                    <p><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p>
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
                                    <th>REMARKS</th>
                                </tr>
                            </thead>
        
                            <tbody id="tblBody">
                                <?php
                                    $count = 1; 
                                    foreach ($units as $unit) {
                                        $unitID =  $unit['unit_ID']; 
                                        $equipmentName = $unit['equipment_name'];
                                        $formattedUnitID = 'UNIT-' . str_pad($unitID, 4, '0', STR_PAD_LEFT);
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>$formattedUnitID</td>";
                                        echo "<td>$equipmentName</td>";

                                        $query = "SELECT property_number, account_code, remarks FROM equipment WHERE article = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param('s', $equipmentName);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                            $propertyNumber = $row['property_number'];
                                            $accountCode = $row['account_code'];
                                            $remarks = $row['remarks'];

                                            echo "<td>$propertyNumber</td>";
                                            echo "<td>$accountCode</td>";
                                            echo "<td>$remarks</td>";
                                        }
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

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>