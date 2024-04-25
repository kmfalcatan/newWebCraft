function popUp2(){
    var popUp = document.querySelector('.addUserContainer');

    if(popUp.style.display === 'none'){
        popUp.style.display = 'block';
    } else if(popUp.style.display === 'block'){
        popUp.style.display = 'none';
    } else{
        popUp.style.display = 'none';
    }
}

// sweet alert
function openModal() {
    var sweetalert = document.getElementById("sweetalert");
    sweetalert.style.display = "block";
    setTimeout(function() {
        sweetalert.style.opacity = 1;
    }, 10);
}

function closeModal() {
    var sweetalert = document.getElementById("sweetalert");
    sweetalert.style.opacity = 0;
    setTimeout(function() {
        sweetalert.style.display = "none";
    }, 300);
}

// search  
function filterUserList() {
    var searchTerm = document.querySelector(".searchBar1").value.trim().toLowerCase();
    var userContainers = document.querySelectorAll(".userContainer4");
    var noResultsMessage = document.querySelector(".noResultsFound");

    var found = false;

    userContainers.forEach(function(container) {
        var userName = container.querySelector(".userNameContainer p").textContent.toLowerCase();

        if (userName.includes(searchTerm)) {
            container.style.display = "";
            found = true;
        } else {
            container.style.display = "none";
        }
    });

    if (found) {
        noResultsMessage.style.display = "none";
    } else {
        noResultsMessage.style.display = "block";
    }
}

document.querySelector(".searchBar1").addEventListener("input", filterUserList);

// validtae password 
function validatePassword(password) {
    const lengthHint = document.getElementById("lengthHint");
    const upperCaseHint = document.getElementById("upperCaseHint");
    const lowerCaseHint = document.getElementById("lowerCaseHint");
    const numberHint = document.getElementById("numberHint");
    const symbolHint = document.getElementById("symbolHint");

    if (password.length >= 6) {
        lengthHint.style.color = "green";
        lengthHint.style.fontWeight = "bold";
    } else {
        lengthHint.style.color = "";
        lengthHint.style.fontWeight = "";
    }

    if (/[A-Z]/.test(password)) {
        upperCaseHint.style.color = "green";
        upperCaseHint.style.fontWeight = "bold";
    } else {
        upperCaseHint.style.color = "";
        upperCaseHint.style.fontWeight = "";
    }

    if (/[a-z]/.test(password)) {
        lowerCaseHint.style.color = "green";
        lowerCaseHint.style.fontWeight = "bold";
    } else {
        lowerCaseHint.style.color = "";
        lowerCaseHint.style.fontWeight = "";
    }

    if (/[0-9]/.test(password)) {
        numberHint.style.color = "green";
        numberHint.style.fontWeight = "bold";
    } else {
        numberHint.style.color = "";
        numberHint.style.fontWeight = "";
    }

    if (/[^a-zA-Z0-9]/.test(password)) {
        symbolHint.style.color = "green";
        symbolHint.style.fontWeight = "bold";
    } else {
        symbolHint.style.color = "";
        symbolHint.style.fontWeight = "";
    }
}

function checkFormSubmission(event) {
    const lengthHint = document.getElementById("lengthHint");
    const upperCaseHint = document.getElementById("upperCaseHint");
    const lowerCaseHint = document.getElementById("lowerCaseHint");
    const numberHint = document.getElementById("numberHint");
    const symbolHint = document.getElementById("symbolHint");

    if (
        lengthHint.style.color !== "green" ||
        upperCaseHint.style.color !== "green" ||
        lowerCaseHint.style.color !== "green" ||
        numberHint.style.color !== "green" ||
        symbolHint.style.color !== "green"
    ) {
        event.preventDefault(); 
        alert("Make sure to complete all the password requirements.");
    }
}

 // *Copyright  © 2024 WebCraft - All Rights Reserved*
    // *Administartive Office Facility Reservation and Management System*
    // *IT 132 - Software Engineering *
    // *(WebCraft) Members:
        // Falcatan, Khriz Marr
        // Gabotero, Rogie
        // Taborada, John Mark
        // Tingkasan, Padwa 
        // Villares, Arp-J*