

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
                    document.getElementById("unitIDDisplay").textContent = "" + unitDetails.unitID;
                    document.getElementById("user_IDDisplay").textContent = "" + unitDetails.user_ID;
                    document.getElementById("equipmentNameDisplay").textContent = "" + unitDetails.equipmentName;

                    if (unitDetails.oldEndUserNames && unitDetails.oldEndUserNames.length > 0) {
                        var oldUserContainer = document.getElementById("oldUserContainer");
                        oldUserContainer.innerHTML = ""; // Clear previous content
                    
                        var oldUserTitleContainer = document.createElement("div");
                        oldUserTitleContainer.classList.add("oldUserTextContainer");
                        var oldUserTitle = document.createElement("p");
                        oldUserTitle.textContent = "OLD END USER";
                        oldUserTitleContainer.appendChild(oldUserTitle);
                        oldUserContainer.appendChild(oldUserTitleContainer);
                    
                        for (var i = 0; i < unitDetails.oldEndUserNames.length; i++) {
                            var oldEndUser = unitDetails.oldEndUserNames[i];
                            var firstName = oldEndUser.firstName;
                            var lastName = oldEndUser.lastName;
                    
                            var oldUserElement = document.createElement("div");
                            oldUserElement.classList.add("unitIDContainer");
                    
                            var yearContainer = document.createElement("div");
                            yearContainer.classList.add("unitID");
                            var yearLabel = document.createElement("p");
                            yearLabel.textContent = "Year:";
                            var yearDisplay = document.createElement("div");
                            yearDisplay.classList.add("unitInputContainer");
                            var yearText = document.createElement("p");
                            yearText.textContent = ""; // Update this with the year value
                            yearDisplay.appendChild(yearText);
                            yearContainer.appendChild(yearLabel);
                            yearContainer.appendChild(yearDisplay);
                    
                            var firstNameContainer = document.createElement("div");
                            firstNameContainer.classList.add("unitID");
                    
                            var firstNameLabel = document.createElement("p");
                            firstNameLabel.textContent = "First name";
                    
                            var firstNameDisplay = document.createElement("div");
                            firstNameDisplay.classList.add("unitInputContainer");
                            var firstNameText = document.createElement("p");
                            firstNameText.id = "oldEndUserFirstNameDisplay";
                            firstNameText.textContent = firstName;
                            firstNameDisplay.appendChild(firstNameText);
                            firstNameContainer.appendChild(firstNameLabel);
                            firstNameContainer.appendChild(firstNameDisplay);
                    
                            var lastNameContainer = document.createElement("div");
                            lastNameContainer.classList.add("unitID");
                    
                            var lastNameLabel = document.createElement("p");
                            lastNameLabel.textContent = "Last name";
                    
                            var lastNameDisplay = document.createElement("div");
                            lastNameDisplay.classList.add("unitInputContainer");
                            var lastNameText = document.createElement("p");
                            lastNameText.id = "oldEndUserLastNameDisplay";
                            lastNameText.textContent = lastName;
                            lastNameDisplay.appendChild(lastNameText);
                            lastNameContainer.appendChild(lastNameLabel);
                            lastNameContainer.appendChild(lastNameDisplay);
                    
                            oldUserElement.appendChild(yearContainer);
                            oldUserElement.appendChild(firstNameContainer);
                            oldUserElement.appendChild(lastNameContainer);
                            oldUserContainer.appendChild(oldUserElement);
                        }
                    } else {
                        var oldUserContainer = document.getElementById("oldUserContainer");
                        oldUserContainer.style.display = "none";
                    }

                    // unit history

                    if (unitDetails.unitIssues && unitDetails.unitIssues.length > 0) {
                        var unitHistoryContainer = document.getElementById("unitHistory");
                        unitHistoryContainer.innerHTML = ""; 
                    
                        var unitHistoryTextContainer = document.createElement("div");
                        unitHistoryTextContainer.classList.add("oldUserTextContainer");
                        var unitHistoryTitle = document.createElement("p");
                        unitHistoryTitle.textContent = "UNIT HISTORY";
                        unitHistoryTextContainer.appendChild(unitHistoryTitle);
                        unitHistoryContainer.appendChild(unitHistoryTextContainer);
                    
                        for (var i = 0; i < unitDetails.unitIssues.length; i++) {
                            var unitIssue = unitDetails.unitIssues[i];
                            var reportIssue = unitIssue.reportIssue;
                            var timestamp = unitIssue.timestamp;
                    
                            var unitIssueElement = document.createElement("div");
                            unitIssueElement.classList.add("unitIDContainer");
                            unitIssueElement.style.width = "80%";
                            unitIssueElement.style.margin = "auto";

                    
                            var reportIssueContainer = document.createElement("div");
                            reportIssueContainer.classList.add("unitID");
                    
                            var reportIssueLabel = document.createElement("p");
                            reportIssueLabel.textContent = "Unit issue";
                    
                            var reportIssueDisplay = document.createElement("div");
                            reportIssueDisplay.classList.add("unitInputContainer");
                            var reportIssueText = document.createElement("p");
                            reportIssueText.textContent = reportIssue;
                            reportIssueDisplay.appendChild(reportIssueText);
                            reportIssueContainer.appendChild(reportIssueLabel);
                            reportIssueContainer.appendChild(reportIssueDisplay);
                    
                            var dateContainer = document.createElement("div");
                            dateContainer.classList.add("unitID");

                            var dateLabel = document.createElement("p");
                            dateLabel.textContent = "Date";

                            var dateDisplay = document.createElement("div");
                            dateDisplay.classList.add("unitInputContainer");
                            var dateText = document.createElement("p");

                            var formattedDate = formatDate(new Date(timestamp));
                            dateText.textContent = formattedDate;

                            dateDisplay.appendChild(dateText);
                            dateContainer.appendChild(dateLabel);
                            dateContainer.appendChild(dateDisplay);

                            unitIssueElement.appendChild(reportIssueContainer);
                            unitIssueElement.appendChild(dateContainer);

                            unitHistoryContainer.appendChild(unitIssueElement);

                        }
                    } else {
                        var unitHistoryContainer = document.getElementById("unitHistory");
                        unitHistoryContainer.style.display = "none";
                    }
                    
                    
                    if (unitDetails.firstName) {
                        document.getElementById("firstNameDisplay").textContent = "" + unitDetails.firstName;
                    }

                    if (unitDetails.lastName) {
                        document.getElementById("lastNameDisplay").textContent = "" + unitDetails.lastName;
                    }

                    if (unitDetails.userName) {
                        document.getElementById("userNameDisplay").textContent = "" + unitDetails.userName;
                    }

                    if (unitDetails.designation) {
                        document.getElementById("designationDisplay").textContent = "" + unitDetails.designation;
                    }

                    if (unitDetails.department) {
                        document.getElementById("departmentDisplay").textContent = "" + unitDetails.department;
                    }

                    if (unitDetails.email) {
                        document.getElementById("emailDisplay").textContent = "" + unitDetails.email;
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


                    if (unitDetails.yearReceived) {
                        document.getElementById("yearReceivedDisplay").textContent = "" + unitDetails.yearReceived;
                    }

                    if (unitDetails.unitValue) {
                        document.getElementById("unitValueDisplay").textContent = "" + unitDetails.unitValue;
                    }

                    if (unitDetails.remarks) {
                        document.getElementById("remarksDisplay").textContent = "" + unitDetails.remarks;
                    } else {
                        document.getElementById("remarksDisplay").textContent = "";
                    }

                    if (unitDetails.propertyNumber) {
                        document.getElementById("propertyNumberDisplay").textContent = "" + unitDetails.propertyNumber;
                    }

                    if (unitDetails.accountCode) {
                        document.getElementById("accountCodeDisplay").textContent = "" + unitDetails.accountCode;
                    }

                    if (unitDetails.warrantyEnd && unitDetails.warrantyEnd !== '0000-00-00') {
                        var warrantyEndDate = new Date(unitDetails.warrantyEnd);
                        var currentDate = new Date();
                        var warrantyDisplayElement = document.getElementById("warrantyEndDisplay");
                    
                        var formattedDate = formatDate(warrantyEndDate);
                    
                        if (warrantyEndDate > currentDate) {
                            warrantyDisplayElement.innerHTML = "Warranty will expire on: <span style='color: green; font-weight: bold;'>" + formattedDate + "</span>";
                        } else {
                            warrantyDisplayElement.innerHTML = "Warranty was expired on: <span style='color: red; font-weight: bold;'>" + formattedDate + "</span>";
                        }
                    } else {
                        document.getElementById("warrantyEndDisplay").textContent = "No available warranty for this unit";
                        document.getElementById("warrantyEndDisplay").style.color = "inherit";
                        document.getElementById("warrantyEndDisplay").style.fontWeight = "inherit"; 
                    }
                    

                    if (unitDetails.image) {
                        document.getElementById("imageDisplay").src = unitDetails.image;
                    } else {
                        document.getElementById("imageDisplay").src = "../../assets/img/img_placeholder.jpg";
                    }

                    document.getElementById("popupContainer").style.display = "block";
                } else {
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