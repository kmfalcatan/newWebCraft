

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

    function openPopup() {
    var unitID = document.getElementById("unitID").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText !== "not_exists") {
                    var unitDetails = JSON.parse(xhr.responseText);
                    document.getElementById("unitIDDisplay").textContent = "" + unitDetails.unitID;
                    document.getElementById("userDisplay").textContent = "" + unitDetails.user;
                    document.getElementById("equipmentNameDisplay").textContent = "" + unitDetails.equipmentName;

                    if (unitDetails.deployment) {
                        document.getElementById("deploymentDisplay").textContent = "" + unitDetails.deployment;
                    }

                    if (unitDetails.propertyNumber) {
                        document.getElementById("propertyNumberDisplay").textContent = "" + unitDetails.propertyNumber;
                    }

                    if (unitDetails.accountCode) {
                        document.getElementById("accountCodeDisplay").textContent = "" + unitDetails.accountCode;
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

function closePopup() {
    location.reload();
}
