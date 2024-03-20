var sidebar = document.querySelector('.sideBarContainer6');
var hideButton = document.querySelector('.arrowContainer');
var rotateImg = document.querySelector('.hideIcon');

hideButton.addEventListener('click', function() {
    // Add the class to the element when the button is clicked
    if (sidebar.classList.contains('sideBarContainer6')) {
        sidebar.classList.remove('sideBarContainer6');
        sidebar.classList.add('openSideBar');
    } else {
        // If it hasn't, add the class
        sidebar.classList.add('sideBarContainer6');
        sidebar.classList.remove('openSideBar');
    }

    if(rotateImg.classList.contains('rotate')){
        rotateImg.classList.remove('rotate');
        rotateImg.classList.add('hideIcon');
    } else {
        rotateImg.classList.add('rotate');
        rotateImg.classList.remove('hideIcon');
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