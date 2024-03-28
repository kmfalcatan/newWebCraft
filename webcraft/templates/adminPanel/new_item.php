<?php
 include_once "../../functions/header.php";

$users = []; 
$query = "SELECT user_ID, first_name, last_name FROM users WHERE role = 'user'";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
           $users[] = $row['first_name'] . ' ' . $row['last_name']; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/newItem.css">
    <link rel="stylesheet" href="../../assets/css/OtherInfo.css">
    <link rel="stylesheet" href="../../assets/css/user_profile.css">
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

            <div class="container2" >
            
            <div class="filterContainer1">
                    <div class="inventoryNameContainer">
                        <p>INSERT NEW ITEM</p>
                    </div>

                    <div class="subFilterContainer1">
                        <div class="trackContainer">
                            <a href="inventory.php?id=<?php echo $userID; ?>">
                                <button class="trackButton1">Go to inventory <img src="../../assets/img/unit.png" style="height: 1.9rem;"></button>
                            </a>
                        </div>
                    </div>
                </div>

                <form class="subContainer3"  action="../../functions/save_item.php" enctype="multipart/form-data" method="post"  id="Form1">
                    <!-- first page -->
                    <div class="subUserInfoContainer" style="padding: 2rem 1rem; width: 85%; ">
                        <div class="infoContainer1">
                            <div class="uploadImageContainer1" id="uploadImageContainer1" >
                                <p>Upload equipment image</p>
                                <div class="subUploadImageContainer1">
                                    <div class="imageContainer4">
                                        <img class="image4" id="image3" src="../../assets/img/img_placeholder.jpg" alt="">
                                    </div>
                                </div>

                                <div class="uploadButtonContainer1">
                                    <label class="uploadButton1" type="button">
                                        <img class="uploadIcon1" src="../../assets/img/upload.png" alt="Upload Icon" class="uploadIcon">
                                        upload
                                        <input id="image" name="image" type="file" style="display: none;">
                                    </label>
                                </div>
                            </div>

                            <div class="subInfoContainer1">
                                <div class="inputInfoContainer3">
                                    <div class="subInputInfoContainer3">
                                        <button onclick="dropdown()" type="button" class="inputInfo1">Select End User</button>

                                        <div class="dropdownContainer1"  name="user" id="dropdown" style="display: none;">
                                            <?php
                                                foreach ($users as $enduser) {
                                                    echo '<div class="subDropDownContainer1">';
                                                    echo '<input class="checkBox" name="user" type="checkbox" onchange="handleUserSelection(this, \'' . $enduser . '\')">';
                                                    echo '<p>' . $enduser . '</p>';
                                                    echo '</div>';               
                                                    
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="subInputInfoContainer3">
                                        <div class="subInputInfoContainer3">
                                        <label onclick="viewSelectedUsers()" class="viewButton">Selected end user</label>

                                        <div class="dropdownContainer1" id="dropdown1" style="display: none;">
                                            <div id="selectedUsersContainer" style="text-align: center;"></div>
                                        </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="inputInfoContainer3">
                                    <div class="subInputInfoContainer3">
                                        <input class="inputInfo2" type="text" name="article" placeholder="Article:">
                                    </div>

                                    <div class="subInputInfoContainer3">
                                        <input class="inputInfo2" type="text" name="deployment" placeholder="Deployment:">
                                    </div>
                                </div>

                                <div class="inputInfoContainer3">
                                    <div class="subInputInfoContainer3" style="flex-direction: column;">
                                        <button onclick="dropdown2()" type="button" class="inputInfo8">Distribute unit</button>

                                        <div class="dropdownContainer1" id="dropdown2" style="display: none;">
                                            <div class="labelContainer">
                                                <label class="label" id="user">End user</label>
                                                <label class="label" id="unit">Unit</label>
                                            </div>
                                            <div id="selectedUsersContainer2"></div> 
                                            <div class="subDropDownContainer1">
                                                <button class="saveButton"  onclick="saveUnits()" type="button">save</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="subInputInfoContainer3">
                                        <input class="inputInfo2" type="text" name="total_unit" id="totalUnits" placeholder="Total unit:" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="subContainer6">
                            <div class="subInputInfoContainer3">
                                <input class="inputInfo2" type="text" name="property_number" placeholder="Property number:">
                            </div>

                            <div class="subInputInfoContainer3">
                                <input class="inputInfo2" type="text" name="account_code" placeholder="Account code:">
                            </div>

                            <div class="subInputInfoContainer3">
                                <input class="inputInfo2" type="text" name="unit_value" placeholder="Unit value:">
                            </div>
                        </div>

                        <div class="subContainer6" style="margin-bottom: 0;">

                            <div class="subInputInfoContainer3">
                                <input class="inputInfo2" type="text" name="total_value" placeholder="Total value:">
                            </div>

                            <div class="subInputInfoContainer3">
                                <input class="inputInfo2" type="text" name="remarks" placeholder="Remarks:">
                            </div>

                            <div class="subInputInfoContainer3">
                               <div class="yearContainer">
                                    <p class="year">Year:
                                        <input type="year" name="year_received" id="select-year">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="nb-container">
                            <button class="button4" type="button" onclick="showOverlay()">Next <img src="../../assets/img/arrow-down.png" alt=""></button>
                        </div>
                    </div>

                    <div class="overlay">
                        <div class="infoContainer1">
                            <div class="uploadImageContainer3">
                                <p>Upload warranty image</p>
                                <div class="subUploadImageContainer1">
                                    <div class="imageContainer4">
                                        <img class="image4" id="image4" src="../../assets/img/img_placeholder.jpg" alt="">
                                    </div>
                                </div>
        
                                <div class="uploadButtonContainer6">
                                    <label class="uploadButton6">
                                        <img class="uploadIcon6" src="../../assets/img/upload.png" alt="">
                                        upload
                                        <input id="warranty_image" name="warranty_image" type="file" style="display: none;" >
                                    </label>
                                </div>
                            </div>

                            <div class="subInfoContainer1" id="subInfoContainer1">
                                <div class="inputInfoContainer3">
                                    <div class="subInputInfoContainer3">
                                        <input class="inputInfo2" type="date" name="warranty_start" placeholder="Article:">
                                    </div>

                                    <div class="subInputInfoContainer3" id="subInputInfoContainer3">
                                        <input class="inputInfo2" type="date" name="warranty_end" placeholder="Deployment:">
                                    </div>
                                </div>
                                <div class="descriptionContainer1" id="descriptionContainer1">
                                    <input class="description" name="description" type="text" placeholder="Descripton:">
                                </div>
                                </div>
                            </div>

                            <div class="descriptionContainer1" style=" overflow: auto; flex-direction: column;">
                                <div id="container" class="container-bg">
                                    <label for="instruction" class="step-label">Step how to use</label>
                                    <span class="add-step" onclick="addStep()" style="margin-left: 10rem;"><i class="fas fa-plus" ></i></span>
                                    <div class="step">
                                        <input type="text" id="instruction" class="step-input" name="instruction[]" placeholder="Step 1" />
                                        <span class="add-step" onclick="addStep()" id="hidden"><i class="fas fa-plus" id="hidden"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="nb-container" id="nb-container">
                                <button class="back-button" type="button" onclick="hideOverlay()"><img src="../../assets/img/arrow-down.png"> Back</button>
                                <button class="next" type="submit">Add to inventory</button>
                            </div>
                        </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../assets/js/newItem.js"></script>
    <script src="../../assets/js/uploadImg.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

    <script>
        function showOverlay() {
            const overlay = document.querySelector('.overlay');
            const subUserInfoContainer = document.querySelector('.subUserInfoContainer');
            
            overlay.classList.add('show');
            subUserInfoContainer.style.display = 'none';
            }

        function hideOverlay() {
            const overlay = document.querySelector('.overlay');
            const subUserInfoContainer = document.querySelector('.subUserInfoContainer');
            
            overlay.classList.remove('show');
            subUserInfoContainer.style.display = 'block';
        }
    </script>

<script>
 let stepCounter = 2;

function addStep() {
  const container = document.getElementById("container");

  const newStep = document.createElement("div");
  newStep.classList.add("step");

  const input = document.createElement("input");
  input.type = "text";
  input.classList.add("step-input");
  input.placeholder = "Step " + stepCounter;
  input.name = "instruction[]";
  newStep.appendChild(input);

  const deleteIcon = document.createElement("span");
  deleteIcon.classList.add("delete-step");
  deleteIcon.onclick = function() {
    container.removeChild(newStep);
    updateStepPlaceholders();
  };
  const deleteIconIcon = document.createElement("i");
  deleteIconIcon.classList.add("fas", "fa-trash");
  deleteIcon.appendChild(deleteIconIcon);

  newStep.appendChild(deleteIcon);

  container.appendChild(newStep);

  stepCounter++;
}

function updateStepPlaceholders() {
  const steps = document.getElementsByClassName("step");

  for (let i = 0; i < steps.length; i++) {
    const input = steps[i].getElementsByTagName("input")[0];
    input.placeholder = "Step " + (i + 1);
  }

  stepCounter = steps.length + 1;
}
</script>

</body>
</html>