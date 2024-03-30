<?php
 include_once "../../functions/header.php";
 include_once "../../authentication/auth.php";
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/bin.css">
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
                        <p>REMOVED UNIT LIST</p>
                    </div>

                    <div class="subFilterContainer1" >
                        <div class="searchContainer1">
                            <input class="searchBar1" type="text" name="" id="" placeholder="Search...">
                        </div>

                        <div class="trackContainer">
                            <div class="trackButton">
                                <button onclick="track()" class="trackButton" style="padding: 0 1.5rem;">Unit <span>Replacement</span> <span>Form</span></button>
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
                            </div>
                            <button class="trackButton1">Sort <img src="../../assets/img/sort.png" alt="" style="margin-left: 0.5rem; width: 1.4rem; height: 1.2rem;"></button>
                            <a href="new_item.php?id=<?php echo $userID; ?>">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tableContainer2">

                    <div class="tableContainer">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ARTICLE</th>
                                    <th>PROPERTY NUMBER</th>
                                    <th>ACCOUNT CODE</th>
                                    <th>UNITS</th>
                                    <th>YEAR</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
        
                            <tbody id="tblBody">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button onclick="track4()" class="viewButton6">View</button>
                                        <button class="viewButton6">Restore</button>
                                    </td>  
                                </tr>
                            </tbody>
                        </table>
                   </div>
                </div>
            </div>  

            <div class="viewUnitContainer" style="display: none;">
                <div class="viewUnitContainer">
                    <form class="subViewUnitContainer" action="" method="post">
                        <div class="unitTextContainer">
                            <p>UNIT REPLACEMENT FORM</p>
                        </div>

                        <div class="equipImageContainer">
                            <div class="subEquipImageContainer">
                                <img class="subEquipImageContainer" src="" alt="">
                            </div>
                        </div>

                        <div class="unitInfoContainer">
                            <div class="subUnitInfoContainer" id="subUnitInfoContainer">
                                <div class="unitIdContainer" id="unitIdContainer">
                                   <p style="font-weight: bold;">CHSDKSJD</p>
                                   <p>asdnnas</p>
                                   <p>423423</p>
                                   <p>fsdfsd</p>
                                </div>
                            </div>
                        </div>

                        <div class="unitInfoContainer" >
                            <div class="subUnitInfoContainer" id="subUnitInfoContainer1">
                                <div class="unitIdContainer">
                                    <div class="subUnitIdContainer">
                                        <p>Unit cost <span>*</span></p>
                                    </div>

                                    <input class="displayUnitID" value="ICS-22-F102">
                                </div>

                                <div class="unitIdContainer">
                                    <div class="subUnitIdContainer">
                                        <p>Datre replacement <span>*</span></p>
                                    </div>

                                    <input class="displayUnitID" value="ICS-22-F102">
                                </div>
                            </div>
                        </div>

                        <div class="unitInfoContainer">
                            <div class="subUnitInfoContainer">
                                <div class="unitIdContainer">
                                    <div class="subUnitIdContainer">
                                        <p>First name <span>*</span></p>
                                    </div>

                                    <input class="displayUnitID" value="ICS-22-F102">
                                </div>

                                <div class="unitIdContainer">
                                    <div class="subUnitIdContainer">
                                        <p>Last name <span>*</span></p>
                                    </div>

                                    <input class="displayUnitID" value="ICS-22-F102">
                                </div>
                            </div>
                        </div>

                        <div class="buttonContainer2">
                            <button  class="button3" type="button" onclick="track3()">Cancel</button>
                            <button class="button4" type="submit" onclick="track1()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="viewApproveContainer" style="display: none;">
                <div class="viewApproveContainer">
                    <div class="subViewApproveContainer">
                        <div class="unitTextContainer">
                            <p>UNIT DETAILS</p>
                        </div>
                        <div class="viewInfoContainer">
                            <div class="imageContainer4">
                                <div class="subImageContainer5">
                                    <img class="subImageContainer5" src="" alt="">
                                </div>

                                <div class="equipNameContainer">
                                    <p>Laptop</p>
                                </div>
                            </div>

                            <div class="approveInfoContainer">
                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>End user</p>
                                        </div>

                                        <div class="container4">
                                            <p class="text1">Khriz marr L. Falcatan</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Deployment</p>
                                        </div>

                                        <div class="container4">
                                            <p class="text1">Khriz marr L. Falcatan</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="subApproveInfoContainer1">
                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Property number</p>
                                        </div>

                                        <div class="container4">
                                            <p class="text1">Khriz marr L. Falcatan</p>
                                        </div>
                                    </div>

                                    <div class="approveContainer">
                                        <div class="labelContainer1">
                                            <p>Account code</p>
                                        </div>

                                        <div class="container4">
                                            <p class="text1">Khriz marr L. Falcatan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="unitContainer6">
                            <div class="unitRemoved">
                                <p>UNIT REMOVED</p>
                            </div>
                            <div class="subApproveInfoContainer1">
                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p style="color: snow;">Unit ID</p>
                                    </div>

                                    <div class="container4" id="container4">
                                        <p class="text1">UNIT-0001</p>
                                    </div>
                                </div>

                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Unit issue</p>
                                    </div>

                                    <div class="container4">
                                        <p class="text1">Khriz marr L. Falcatan</p>
                                    </div>
                                </div>

                                <div class="approveContainer">
                                    <div class="labelContainer1">
                                        <p>Problem description</p>
                                    </div>

                                    <div class="container4">
                                        <p class="text1">Khriz marr L. Falcatan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="buttonContainer2">
                            <div onclick="track4()" class="button3">
                                <p>Cancel</p>
                            </div>

                            <div onclick="track4()" class="button4" onclick="track1()">
                                <p>Restore</p>
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