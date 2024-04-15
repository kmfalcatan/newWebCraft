

function track(){
    var container = document.querySelector('.trackButton');
    var popUp = document.querySelector('.subTrackContainer');
    var close = document.querySelector('.button3');

    if(popUp.style.display === 'none'){
        popUp.style.display = 'block';
    } else if(popUp.style.display === 'block'){
        popUp.style.display = 'none';
    } else{
        popUp.style.display = 'none';
    }
}

function track1(){
    var popUp = document.querySelector('.trackUnitContainer');

    if(popUp.style.display === 'none'){
        popUp.style.display = 'block';
    } else if(popUp.style.display === 'block'){
        popUp.style.display = 'none';
    } else{
        popUp.style.display = 'none';
    }
}

function track2(){
    var popUp1 = document.querySelector('.subUnitsContainer');

    if(popUp1.style.display === 'none'){
        popUp1.style.display = 'block';
    } else if(popUp1.style.display === 'block'){
        popUp1.style.display = 'none';
    } else{
        popUp1.style.display = 'none';
    }
}

function track3(){
    var popUp1 = document.querySelector('.viewUnitContainer');

    if(popUp1.style.display === 'none'){
        popUp1.style.display = 'block';
    } else if(popUp1.style.display === 'block'){
        popUp1.style.display = 'none';
    } else{
        popUp1.style.display = 'none';
    }
}

function track4(){
    var popUp1 = document.querySelector('.viewApproveContainer');

    if(popUp1.style.display === 'none'){
        popUp1.style.display = 'block';
    } else if(popUp1.style.display === 'block'){
        popUp1.style.display = 'none';
    } else{
        popUp1.style.display = 'none';
    }
}

// current year


// tracker
function openPopup() {
    var unitID = document.getElementById("unitID").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText !== "not_exists") {
                    var unitDetails = JSON.parse(xhr.responseText);
                    document.getElementById("firstNameDisplay").textContent = unitDetails.firstName + " " + unitDetails.middleInitial + " " + unitDetails.lastName;
                    document.getElementById("userNameDisplay").textContent = "" + unitDetails.userName;
                    document.getElementById("emailDisplay").textContent = "" + unitDetails.email;
                    document.getElementById("designationDisplay").textContent = "" + unitDetails.designation;
                    document.getElementById("departmentDisplay").textContent = "" + unitDetails.department;
                    // unit info
                    document.getElementById("propertyNumberDisplay").textContent = "" + unitDetails.propertyNumber;
                    document.getElementById("accountCodeDisplay").textContent = "" + unitDetails.accountCode;
                    document.getElementById("unitValueDisplay").textContent = "" + unitDetails.unitValue;
                    document.getElementById("yearReceivedDisplay").textContent = "" + unitDetails.yearReceived;
                    document.getElementById("descriptionDisplay").textContent = "" + unitDetails.description;
                    document.getElementById("remarksDisplay").textContent = "" + unitDetails.remarks;
                    var imageDisplayElement = document.getElementById("imageDisplay");
                    imageDisplayElement.src = unitDetails.image;
                    var warrantyStatusElement = document.getElementById("warrantyStatusDisplay");
                
                    var warrantyEndDate = new Date(unitDetails.warrantyEnd);
                    var currentDate = new Date();
                
                    if (warrantyEndDate > currentDate) {
                        warrantyStatusElement.innerHTML = "<span style='color: green;'>Active</span> <span style='font-weight: lighter;'>until</span> " + formatDate(warrantyEndDate);
                    } else {
                        warrantyStatusElement.innerHTML = "<span style='color: red;'>Expired</span> <span style='font-weight: lighter;'>since</span> " + formatDate(warrantyEndDate);
                    }

                    var unitYearReceivedDisplay = document.getElementById("unitYearReceivedDisplay");
                    var currentYear = new Date().getFullYear();
                    var unitYearReceived = parseInt(unitDetails.unitYearReceived);

                    if (!isNaN(unitYearReceived)) {
                        if (unitYearReceived === currentYear) {
                            unitYearReceivedDisplay.textContent = currentYear;
                        } else {
                            unitYearReceivedDisplay.textContent = unitYearReceived + " - " + "Present";
                        }
                    } else {
                        unitYearReceivedDisplay.textContent = "N/A";
                    }
                    
                    if (unitDetails.oldEndUserNames && unitDetails.oldEndUserNames.length > 0) {
                        var oldUserContainer = document.getElementById("oldUserContainer");
                        oldUserContainer.innerHTML = ""; // Clear previous content
                    
                        var oldUserTitleContainer = document.createElement("div");
                        oldUserTitleContainer.classList.add("oldUserTextContainer");
                        var oldUserTitle = document.createElement("p");
                        oldUserTitle.textContent = "OLD END USER";
                        oldUserTitleContainer.appendChild(oldUserTitle);
                        oldUserContainer.appendChild(oldUserTitleContainer);
                    
                        unitDetails.oldEndUserNames.sort(function(a, b) {
                            return b.year_transfer - a.year_transfer;
                        });
                    
                        var earliestYear = unitDetails.oldEndUserNames[unitDetails.oldEndUserNames.length - 1].year_transfer;
                        var latestYear = unitDetails.oldEndUserNames[0].year_transfer;
                    
                        if (earliestYear !== latestYear) {
                            var yearRange = earliestYear + "-" + latestYear;
                            displayOldUserDetails(yearRange, latestYear);
                        } else {
                            displayOldUserDetails(earliestYear);
                        }
                    }
                    
                    function displayOldUserDetails(yearRange, latestYear) {
                        for (var i = 0; i < unitDetails.oldEndUserNames.length; i++) {
                            var oldEndUser = unitDetails.oldEndUserNames[i];
                            var firstName = oldEndUser.firstName;
                            var lastName = oldEndUser.lastName;
                    
                            var oldUserElement = document.createElement("div");
                            oldUserElement.classList.add("oldUserContainer");
                    
                            var oldUserInfoContainer = document.createElement("div");
                            oldUserInfoContainer.classList.add("infoContainer1");
                    
                            var unitIDContainer1 = document.createElement("div");
                            unitIDContainer1.classList.add("unitIDContainer1");
                    
                            var yearInfo = document.createElement("div");
                            yearInfo.classList.add("unitInfo");
                            var yearLabel = document.createElement("label");
                            yearLabel.setAttribute("for", "");
                            yearLabel.textContent = "Year:";
                            var yearText = document.createElement("p");
                            if (latestYear && oldEndUser.year_transfer !== latestYear) {
                                yearText.textContent = yearRange;
                            } else {
                                yearText.textContent = oldEndUser.year_transfer;
                            }
                            yearInfo.appendChild(yearLabel);
                            yearInfo.appendChild(yearText);
                    
                            var oldUserInfo = document.createElement("div");
                            oldUserInfo.classList.add("olduserInfo");
                    
                            var nameInfo = document.createElement("div");
                            nameInfo.classList.add("unitInfo");
                            var nameLabel = document.createElement("label");
                            nameLabel.setAttribute("for", "");
                            nameLabel.textContent = "Name:";
                            var nameText = document.createElement("p");
                            nameText.textContent = firstName + " " + (oldEndUser.middleInitial ? oldEndUser.middleInitial + " " : "") + lastName;
                            nameInfo.appendChild(nameLabel);
                            nameInfo.appendChild(nameText);
                    
                            var usernameInfo = document.createElement("div");
                            usernameInfo.classList.add("unitInfo");
                            var usernameLabel = document.createElement("label");
                            usernameLabel.setAttribute("for", "");
                            usernameLabel.textContent = "Username:";
                            var usernameText = document.createElement("p");
                            usernameText.textContent = oldEndUser.username; 
                            usernameInfo.appendChild(usernameLabel);
                            usernameInfo.appendChild(usernameText);
                    
                            var emailInfo = document.createElement("div");
                            emailInfo.classList.add("unitInfo");
                            var emailLabel = document.createElement("label");
                            emailLabel.setAttribute("for", "");
                            emailLabel.textContent = "E-mail:";
                            var emailText = document.createElement("p");
                            emailText.textContent = oldEndUser.email;
                            emailInfo.appendChild(emailLabel);
                            emailInfo.appendChild(emailText);
                    
                            var designationInfo = document.createElement("div");
                            designationInfo.classList.add("unitInfo");
                            var designationLabel = document.createElement("label");
                            designationLabel.setAttribute("for", "");
                            designationLabel.textContent = "Designation:";
                            var designationText = document.createElement("p");
                            designationText.textContent = oldEndUser.designation; 
                            designationInfo.appendChild(designationLabel);
                            designationInfo.appendChild(designationText);
                    
                            var departmentInfo = document.createElement("div");
                            departmentInfo.classList.add("unitInfo");
                            var departmentLabel = document.createElement("label");
                            departmentLabel.setAttribute("for", "");
                            departmentLabel.textContent = "Department:";
                            var departmentText = document.createElement("p");
                            departmentText.textContent = oldEndUser.department; 
                            departmentInfo.appendChild(departmentLabel);
                            departmentInfo.appendChild(departmentText);
                    
                            oldUserInfo.appendChild(nameInfo);
                            oldUserInfo.appendChild(usernameInfo);
                            oldUserInfo.appendChild(emailInfo);
                            oldUserInfo.appendChild(designationInfo);
                            oldUserInfo.appendChild(departmentInfo);
                    
                            unitIDContainer1.appendChild(yearInfo);
                            unitIDContainer1.appendChild(oldUserInfo);
                            oldUserInfoContainer.appendChild(unitIDContainer1);
                            oldUserInfoContainer.appendChild(oldUserElement);
                            oldUserContainer.appendChild(oldUserInfoContainer);
                        }
                    }

                    // unit history

                    

                    document.getElementById("popupContainer").style.display = "block";
                }
                 else {
                    document.getElementById("unitIDDisplay").textContent = "Unit id does not exist";
                    document.getElementById("popupContainer").style.display = "block";
                    document.getElementById("unitIDDisplay").style.color = "red";
                    document.getElementById("unitIDDisplay").style.textTransform = "initial";
                    document.getElementById("unitIDDisplay").style.fontWeight = "lighter";
                }
            } else {
                console.error("Error checking unit ID existence: " + xhr.statusText);
            }
        }
    };
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("unitID=" + unitID);
}

function displayUnitHistory(issues) {
    var unitHistoryContainer = document.getElementById("oldUserContainer");
    var unitHistoryTitle = document.createElement("div");
    unitHistoryTitle.classList.add("oldUserTextContainer");
    var unitHistoryTitleText = document.createElement("p");
    unitHistoryTitleText.textContent = "UNIT HISTORY";
    unitHistoryTitle.appendChild(unitHistoryTitleText);
    unitHistoryContainer.appendChild(unitHistoryTitle);

    issues.forEach(function(issue) {
        var issueContainer = document.createElement("div");
        issueContainer.classList.add("infoContainer1");

        var issueDiv = document.createElement("div");
        issueDiv.classList.add("unitIssue");

        var issueInfo = document.createElement("div");
        issueInfo.classList.add("unitInfo");
        var issueLabel = document.createElement("label");
        issueLabel.textContent = "Unit Issue:";
        var issueText = document.createElement("p");
        issueText.textContent = issue.reportIssue;
        issueInfo.appendChild(issueLabel);
        issueInfo.appendChild(issueText);

        var dateInfo = document.createElement("div");
        dateInfo.classList.add("unitInfo");
        var dateLabel = document.createElement("label");
        dateLabel.textContent = "Date:";
        var dateText = document.createElement("p");
        dateText.textContent = formatDate(new Date(issue.timestamp));
        dateInfo.appendChild(dateLabel);
        dateInfo.appendChild(dateText);

        issueDiv.appendChild(issueInfo);
        issueDiv.appendChild(dateInfo);

        issueContainer.appendChild(issueDiv);
        unitHistoryContainer.appendChild(issueContainer);
    });
}

function formatDate(date) {
    const monthNames = ["January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"];
    const day = ("0" + date.getDate()).slice(-2);
    const monthIndex = date.getMonth();
    const year = date.getFullYear();

    return `${monthNames[monthIndex]} ${day}, ${year}`;
}

function closePopup() {
    location.reload();
}
