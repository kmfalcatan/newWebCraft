<?php
    include_once "../../functions/header.php";
    include_once "../../authentication/auth.php";
    include_once "../../dbConfig/dbconnect.php";

    $userID = $_GET['id'];

    $unitID = $_GET['unitID'] ?? '';
    $reportReason = $_GET['reportReason'] ?? '';
    $formattedUnitID = 'UNIT-' . str_pad($unitID, 4, '0', STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY POFILE</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/equip_details.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/newItem.css">
</head>
<style>
    .container4{
        width: 95%;
    }
    
</style>
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

                <div class="subHeaderContainer1" >
                    <div class="logoNameContainer1">
                        <img class="systemName" src="../../assets/img/system-name.png" alt="">
                    </div>
                    <div class="subImageContainer3">
                        <img class="image11" src="../../assets/img/medLogo.png" alt="">
                    </div>
                </div>
            </div>

            <div class="subContainer1" id="containerToReplace">
                <div class="equipContainer">
                <div class="filterContainer1" style="width: 100%; margin-top: 0rem;">
                    <div class="inventoryNameContainer">
                        <p>REVIEW UNIT DETAILS</p>
                    </div>

                    <div class="subFilterContainer1">
                    </div>
                </div>
                
                    <form class="subViewApproveContainer" action="" method="post">
                        <div class="viewInfoContainer" id="viewInfoContainer">
                            <div class="imageContainer4" >
                                <div class="equipImage" >
                                    <img class="equipImage2"  src="" alt="Mountain Placeholder" onerror="this.onerror=null; this.src='../../assets/img/img_placeholder.jpg';">
                                </div>

                                <div class="equipNameContainer" id="article" s>
                                    <p>zxczx</p>
                                </div>
                            </div>

                            <div class="approveInfoContainer">
                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>End user</p>
                                        </div>

                                        <input class="container4" type="text">
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Deployment</p>
                                        </div>

                                        <input class="container4" type="text">
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Property number</p>
                                        </div>

                                        <input class="container4" type="text">
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Account code</p>
                                        </div>

                                        <input class="container4" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="unitSelected">
                            <p>SELECTED UNIT</p>
                        </div>

                        <div class="subApproveInfoContainer2" style="margin: 1rem auto;">

                            <div class="imageContainer4" id="imageContainer4">
                                <div class="equipImage" >
                                    <img class="equipImage2" id="image3"  src="" alt="Mountain Placeholder" onerror="this.onerror=null; this.src='../../assets/img/img_placeholder.jpg';">
                                </div>

                                <div class="uploadButtonContainer1">
                                    <label class="uploadButton1" type="button">
                                        <img class="uploadIcon1" src="../../assets/img/upload.png" alt="Upload Icon" class="uploadIcon">
                                        upload
                                        <input id="image" name="image" type="file" style="display: none;">
                                    </label>
                                </div>
                            </div>

                            <div class="selectedContainer">
                                <div class="selectedunitInfo">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit ID</p>
                                        </div>

                                        <input class="container4" type="text" name="unit_ID" style="margin-right: 0.5rem;" value="<?php echo $formattedUnitID ?>">
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Unit issue</p>
                                        </div>

                                        <input class="container4" type="text" name="issue" value=" <?php echo $reportReason ?>">
                                    </div>
                                </div>

                                <div class="descContainer">
                                    <div class="labelContainer1">
                                        <p>Problem description <span>*</span></p>
                                    </div>

                                    <input class="container4" type="text">
                                </div>
                            </div>
                            
                        </div>
                       
                        <div class="buttonContainer2" id="buttonContainer2" style="width: 92.5%;">
                            <button class="button4" id="confirm-submit">Submit</button>
                            <a href="my_units.php?id=<?php echo $userID; ?>">
                                <button class="button3"  id="cancel-submit" type="button">Cancel</button>
                            </a>
                        </div>
                        </div>
                    </form>
                </div>
            
            </div>  
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/uploadImg.js"></script>

</body>
</html>