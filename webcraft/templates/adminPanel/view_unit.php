<?php 
 include_once "../../dbConfig/dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/equip_other_info.css">
    <link rel="stylesheet" href="../../assets/css/view_unit.css">
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

            <div class="container1">
                <div class="header">
                    <button class="backbtn">
                        <a href="dashboard.php?id=<?php echo $userID; ?>"><img src="../assets//img/left-arrow.png" style="width: 1.5rem; height: 1.5rem;" ></a>
                    </button>
                    <?php
                        $result_article = $conn->query("SELECT article FROM equipment WHERE equipment_ID = '$equipment_ID'");
        
                        if ($result_article->num_rows > 0 && $article = $result_article->fetch_assoc()) {
                            echo "<h2>{$article['article']} available unit list</h2>";
                        }
                    ?>
                <div class="searchContainer">
                    <input class="searchBar" type="text" id="searchInput" placeholder="Search..." oninput="liveSearch()">
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
                    
                    echo "<div class='equipContainer'>";
                    echo "<div class='subEquipContainer'>";
                    echo "<div class='imageContainer6'>";
                    echo "<img class='image3' src='$imageURL' alt=''>";
                    echo "</div>";
                    echo "<div class='infoContainer'>";
                    echo "<div class='subInfoContainer'>";
                    echo "<div class='statusContainer1" . ($isNew ? " new" : "") . "'>";
                    echo "<p class='status1'>" . ($isNew ? "NEW" : "OLD") . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='subInfoContainer1'>";
                    echo "<p class='text'><strong>$equipment_name</strong></p>";
                    echo "</div>";
                    echo "<div class='subInfoContainer1'>";
                    echo "<p  class='text'>$unitID</p>";
                    echo "</div>";
                    echo "<div class='subInfoContainer1'>";
                    echo "<p  class='text'>$user</p>";
                    echo "</div>";
        
                    echo "<div class='subInfoContainer'>";
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
                            echo "<a href='viewEquip.php?equipment_ID=$equipment_ID&id=$userID&page=$prevPage'><button class='previousbtn'>";
                            echo "<span><img src='../assets/img/chevron-left (1).png' alt='' style='height: 1rem; width: 1rem;'></span>";
                            echo "<span>Previous</span>";
                            echo "</button></a>";
                        ?>
        
                        <div class="pageIndicator"><?php echo $currentPage; ?></div>
        
                        <?php
                            $nextPage = $currentPage + 1;
                            echo "<a href='viewEquip.php?equipment_ID=$equipment_ID&id=$userID&page=$nextPage'><button class='nextbtn'>";
                            echo "<span>Next</span>";
                            echo "<span><img src='../assets/img/chevron-right.png' alt='' style='height: 1rem; width: 1rem;'></span>";
                            echo "</button></a>";
                        ?>
                    </div>
                </div>
        
                <!-- history -->
                <div class="container3" style="display: none;">
                    <div class="container4">
                        <div class="subContainer3">
                            <div class="equipmentNameContainer">
                                <p>Equipment history</p>
                            </div>
            
                            <div class="issueContainer">
                                <div class="subIssueContainer">
                                    <p>Issue: Lost</p>
                                </div>
            
                                <div class="subIssueContainer">
                                    <p>Date: 03/03/2024</p>
                                </div>
                            </div>
            
                            <div class="cancelContainer">
                                <div class="subCancelContainer">
                                    <button onclick="popup1()" class="cancelButton" type="button">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>