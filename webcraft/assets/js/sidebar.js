// var sidebar = document.querySelector('.sideBarContainer6');
// var hideButton = document.querySelector('.arrowContainer');
// var rotateImg = document.querySelector('.hideIcon');

// hideButton.addEventListener('click', function() {
//     if (sidebar.classList.contains('sideBarContainer6')) {
//         sidebar.classList.remove('sideBarContainer6');
//         sidebar.classList.add('openSideBar');
//     } else {
//         sidebar.classList.add('sideBarContainer6');
//         sidebar.classList.remove('openSideBar');
//     }

//     if(rotateImg.classList.contains('rotate')){
//         rotateImg.classList.remove('rotate');
//         rotateImg.classList.add('hideIcon');
//     } else {
//         rotateImg.classList.add('rotate');
//         rotateImg.classList.remove('hideIcon');
//     }

// });

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