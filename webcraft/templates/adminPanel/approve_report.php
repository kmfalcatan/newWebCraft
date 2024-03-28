<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/approve_report.css">
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
                    <div class="subIconContainer10">
                        <img class="subIconContainer10" src="" alt="">
                    </div>
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

            <div class="container2">
                <div class="subContainer2">
                    <div class="headerContainer2">
                        <a href="../admin panel/reportList.php?id=<?php echo $userID; ?>">
                            <div class="backContainer">
                                <img class="image3" src="../assets/img/left-arrow.png" alt="">
                            </div>
                        </a>
        
                        <div class="iconContainer">
                            <div class="textContainer10">
                                <p>lakshdkasgd</p>
                            </div>
                            
                            <div class="subIconContainer">
                                <img src="" alt="">
                            </div>
                        </div>
                    </div>
        
                    <form class="infoContainer" action="../functions/approveReport.php" method="post"  enctype="multipart/form-data">
                        <input type="hidden" name="user_ID" value="<?php echo $user_ID ?>">
        
                        <div class="subInfoContainer">
                            <div class="imageContainer2">
                                <div class="subImageContainer2">
                                    <?php if (!empty($image_url)): ?>
                                        <img class="image8" src="../uploads/<?php echo $image_url; ?>" alt="">
                                    <?php else: ?>
                                        <img class="image8" src="../assets/img/img_placeholder.jpg" alt="">
                                    <?php endif; ?>
                                </div>
        
                                <div class="equipNameContainer">
                                    <input type="text" class="article" name="article" value="<?php echo $article; ?>" readonly>
                                </div>
                            </div>
        
                            <div class="equipInfoContainer">
                                <div class="subEquipInfoContainer">
                                    <div class="userContainer">
                                        <p class="user">User</p>
                                    </div>
        
                                    <div class="subUserContainer">
                                        <input type="text" class="userName2" name="fullname" value="<?php echo $user_full_name; ?>" readonly>
                                    </div>
                                </div>
        
                                <div class="subEquipInfoContainer">
                                    <div class="userContainer">
                                        <p class="user">Deployment</p>
                                    </div>
        
                                    <div class="subUserContainer">
                                        <div class="userName2">
                                            <?php echo $deployment; ?>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="subEquipInfoContainer1">
                                    <div class="subEquipInfoContainer">
                                        <div class="userContainer">
                                            <p class="user">Property number</p>
                                        </div>
            
                                        <div class="subUserContainer">
                                            <div class="userName2">
                                                <?php echo $property_number; ?>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="subEquipInfoContainer">
                                        <div class="userContainer">
                                            <p class="user">Account code</p>
                                        </div>
            
                                        <div class="subUserContainer">
                                            <div class="userName2">
                                                <?php echo $account_code; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="descriptionContainer">
                            <div class="description">
                                <p class="user">Description</p>
                            </div>
        
                            <div class="subDescriptionContainer">
                                <div class="userName2">
                                    <?php echo $description; ?>
                                </div>
                            </div>
                        </div>
        
                        <div class="unitContainer">
                            <div class="textContainer">
                                <p>UNITS REPORTED</p>
                            </div>
        
                            <?php foreach ($unit_reports as $index => $report) : ?>
                                <div class="subUnitContainer">
                                    <div class="unitNumberContainer">
                                        <input type="text" class="unitID" name="unit_ID[]" value="<?php echo $report['unit_ID']; ?>">
                                    </div>
        
                                    <div class="unitNumberContainer1">
                                        <div class="issueContainer">
                                            <p class="user">Issue</p>
                                        </div>
        
                                        <div class="subUserContainer">
                                            <input type="text" class="userName2" name="unit_issue[]" value=" <?php echo $report['report_issue']; ?>">
                                        </div>
                                    </div>
        
                                    <div class="unitNumberContainer1">
                                        <div class="issueContainer">
                                            <p class="user">Problem description</p>
                                        </div>
        
                                        <div class="subUserContainer">
                                            <input type="text" class="userName2" name="problem_desc" value="<?php echo $report['problem_desc']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
        
                        <div class="buttonContainer">
                            <button class="button" type="submit" name="approve">Approve</button>
                            <button class="button">Decline</button>
                        </div>
                    </form>
                </div>
            </div>
             </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>