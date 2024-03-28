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
    <link rel="icon" type="image/png" href="../assets/img/webcraftLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/view_inventory.css">
</head>
<body id="body">
    <div class="container1">
        <div class="headerContainer">
            <div class="subHeaderContainer">
                <div class="imageContainer">
                    <div class="subImageContainer">
                        <img class="image" src="assets/img/medLogo.png" alt="">
                    </div>

                    <div class="nameContainer">
                       <img src="assets/img/system-name.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container2" id="container2">
        
        <div class="topContainer">
            <div class="backbtn">
                <a href="landing_page.php"><img src="assets/img/left-arrow.png" alt=""></a>
            </div>
            
            <div class="buttonContainer">
                <a href="about.php">
                    <button class="button1" id="btn">About</button>
                </a>
                <a href="authentication/signin.php">
                    <button class="button1" id="btn2">Sign in</button>
                </a>
            </div>
        </div>
        
        <div class="subContainer2" style="width: 80%;">
            <div class="equipContainer">
                <div class="searchBarContainer1">
                    <input class="searchBar1" type="text" placeholder="Search.." oninput="filterEquipment(this.value)">
                </div>

                <div class="subEquipContainer">
                    <div class="textEquipContainer">
                        <p>Equipment:</p>
                    </div>

                    <ul class="equipment_list">
                        <?php
                        foreach ($equipmentData as $equipmentName => $equipment) {
                            echo "<div class='equipment' onclick='showDetails(\"$equipmentName\")'>
                                    <p>$equipmentName</p>
                                  </div>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="detailsContainer">
                <div class="subDetailsContainer">
                    <div class="imageContainer1">
                        <div class="subImageContainer1">
                            <img class="image12" src="assets/img/img_placeholder.jpg">
                        </div>

                        <div class="subEquipNameContainer">
                            <div class="equipNameContainer">
                                <p id="equipmentName">Equipment name</p>
                            </div>
    
                            <div class="descriptionContainer">
                                <p id="equipmentDescription"></p>
                            </div>
                        </div>
                    </div>

                    <div class="howToUseContainer">
                        <div class="subHowToUseContainer">
                            <p id="howToUse"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/view_inventory.js"></script>

     <script> 
        function showDetails(equipmentName) {
            var equipment = <?php echo json_encode($equipmentData); ?>;
            var selectedEquipment = equipment[equipmentName];
            document.querySelector(".image12").src = "../uploads/" + selectedEquipment['image'];
            document.getElementById("equipmentName").textContent = selectedEquipment['article'];
            document.getElementById("equipmentDescription").textContent = selectedEquipment['description'];
            document.getElementById("howToUse").textContent = selectedEquipment['instruction'];
        }

        function filterEquipment(searchTerm) {
            var equipmentList = document.querySelectorAll('.equipment');
            searchTerm = searchTerm.toLowerCase();
            equipmentList.forEach(function(item) {
                var equipmentName = item.textContent.trim().toLowerCase();
                if (equipmentName.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>