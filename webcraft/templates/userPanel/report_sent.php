<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/inventory.css">
    <link rel="stylesheet" href="../../assets/css/report_list.css">
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
                        <img class="subIconContainer10" src="../../assets/img/notif.png" alt="">
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

            <div class="container" id="reportCotainer">
                <div class="filterContainer" style="height: 4rem;">
                     <div class="subFilterContainer">
                         <div class="sortContainer">
                             <img class="sort" src="../assets/img/th (2).jpg" alt="">
                         </div>
     
                         <div class="filter" onclick="changeColor(this)">
                             <p class="year">Lost</p>
                         </div>
     
                         <div class="filter" onclick="changeColor(this)">
                             <p class="year">Return</p>
                         </div>
     
                         <div class="searchCon">
                             <input class="search" type="text" id="searchInput" placeholder="Search..." oninput="liveSearch()">
                         </div>
     
                     </div>
                </div>
     
                <div class="tableContainer">
                     <table>
                         <tbody>
                             <tr>
                                </a></div></td></tr>
                                    <tr><td><div class='list'>

                                    <div class='sender-img'>
                                            <img src='../uploads/" . ($image ? $image : 'placeholder.jpg') . "' alt='Profile Image'>
                                        </div>
                                        <a href='approveReport.php?report_ID={$report_ID}&user_ID={$currentUserID}&timestamp={$timestamp}&id={$userID}' style='width: 100%;'>
                                            <div class='label' style='display: flex;'>
                                                <p class='left-text'><span>$fullName</span> sent a report.</p>
                                                <div class='right-text'>
                                                    <p class='time'>$timeAgo</p> 
                                                    <button class="viewButton6" style="margin-right: 1rem;">View</button>
                                                </div>
                                            </div>
                                        </a>
                                </a></div></td></tr>
                             </tr>
                         </tbody>
                     </table>
                </div>
             </div>
        </div>
    </div>

    <script src="../../assets/js/inventory.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>