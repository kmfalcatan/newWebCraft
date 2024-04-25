

document.getElementById('toggleButton').addEventListener('click', function() {
    var sidebar = document.querySelector('.sidebar');
    var mainContainer = document.querySelector('.mainContainer');
    var headerContainer = document.querySelector('.headerContainer1');
    var body = document.querySelector('body');
    
    if (body.classList.contains('sidebar-hidden')) {
        body.classList.remove('sidebar-hidden');
        mainContainer.style.transition = 'margin-left 0.3s ease-in-out';
        headerContainer.style.transition = 'margin-left 0.3s ease-in-out';
        mainContainer.style.marginLeft = '250px';
        headerContainer.style.left = '16rem';
    } else {
        body.classList.add('sidebar-hidden');
        mainContainer.style.transition = 'margin-left 0.3s ease-in-out';
        headerContainer.style.transition = 'margin-left 0.3s ease-in-out';
        mainContainer.style.marginLeft = '0';
        headerContainer.style.left = '0';
    }
});




function setting1(){
    var container = document.querySelector('.buttonContainer1');
    var popUp = document.querySelector('.settingContainer');

    if(popUp.style.display === 'none'){
        popUp.style.display = 'block';
    } else {
        popUp.style.display = 'none';
    }
}

// logout
function showLogoutConfirmation() {
    document.getElementById("logoutConfirmation").style.display = "block";
}

function hideLogoutConfirmation() {
    document.getElementById("logoutConfirmation").style.display = "none";
}

function logout() {
    window.location.href = "../../functions/signout.php";
}

function showWarrantyContainer() {
    document.getElementById("warrantyContainer").style.display = "block";
}

function hideWarrantyContainer() {
    document.getElementById("warrantyContainer").style.display = "none";
}

function logout() {
    window.location.href = "../../functions/signout.php";
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