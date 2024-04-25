<?php
include 'dbConfig/dbconnect.php';

$query = "SELECT * FROM equipment";
$result = mysqli_query($conn, $query);

$equipmentData = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $equipmentData[$row['article']] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap">
    <link rel="icon" type="image/png" href="assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/view_inventory.css">
    <link rel="stylesheet" href="assets/css/inventory.css">
</head>
<body>
    <div class="mainContainer">
        <div class="headerContainer1">
            <div class="iconContainer10">
            </div>

            <div class="subHeaderContainer1">
                <div class="logoNameContainer1">
                    <img class="systemName" src="assets/img/system-name.png" alt="">
                </div>
                <div class="subImageContainer3">
                    <img class="image11" src="assets/img/medLogo.png" alt="">
                </div>
            </div>
        </div>

        <div class="inventoryContainer">
            <div class="topContainer">
                <div class="topbtn">
                    <p class="label">INVENTORY</p>
                    <a href="about.php">
                        <button>About</button>
                    </a>
                    <a href="contact.php">
                        <button>Contact</button>
                    </a>
                    <a href="authentication/signin.php">
                        <button class="signinbtn">Sign in</button>
                    </a>
                </div>
            </div>

            <div class="bodyContainer">
                <div class="leftContainer">
                    <div class="searchContainer">
                        <input class="searchBar" type="text" placeholder="Search.." oninput="filterEquipment(this.value)">
                    </div>

                    <div class="listContainer">
                        <div class="listTitle">
                            <h3>EQUIPMENT LIST</h3>
                        </div>
                        <ul class="list-container">
                            <?php
                                foreach ($equipmentData as $equipmentName => $equipment) {
                                    echo "<div class='list' onclick='showDetails(\"$equipmentName\")'>
                                            <li>$equipmentName</li>
                                        </div>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="rightContainer">
                    <div  class="rightContent">
                        <div class="first-row">
                            <div class="imgContainer">
                                <img class="image12" src="assets/img/img_placeholder.jpg">
                            </div>
                            <div class="equipContainer">
                                <div class="equipName">
                                    <p id="equipmentName"></p>
                                </div>

                                <div class="equipDesc">
                                    <p id="equipmentDescription"></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="second-row">
                                <div class="equipInstruct">
                                    <p id="howToUse"></p>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script> 
        function showDetails(equipmentName) {
            var equipment = <?php echo json_encode($equipmentData); ?>;
            var selectedEquipment = equipment[equipmentName];
            document.querySelector(".image12").src = "uploads/" + selectedEquipment['image'];
            document.getElementById("equipmentName").textContent = selectedEquipment['article'];
            document.getElementById("equipmentDescription").textContent = selectedEquipment['description'];
            document.getElementById("howToUse").textContent = selectedEquipment['instruction'];
        }

        function filterEquipment(searchTerm) {
            var equipmentList = document.querySelectorAll(".list");
            searchTerm = searchTerm.toLowerCase();
            var resultsFound = false;

            equipmentList.forEach(function (equipment) {
                var equipmentName = equipment.textContent.toLowerCase();
                if (equipmentName.includes(searchTerm)) {
                    equipment.style.display = "block";
                    resultsFound = true;
                } else {
                    equipment.style.display = "none";
                }
            });

            var noResultsMessage = document.getElementById("noResultsMessage");
            if (!resultsFound) {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement("p");
                    noResultsMessage.id = "noResultsMessage";
                    noResultsMessage.textContent = "No results found";
                    document.querySelector(".listContainer").appendChild(noResultsMessage);
                } else {
                    noResultsMessage.style.display = "block";
                }
            } else if (noResultsMessage) {
                noResultsMessage.style.display = "none";
            }
        }
    </script>
</body>
</html>