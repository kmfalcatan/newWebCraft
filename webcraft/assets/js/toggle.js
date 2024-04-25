// view more for user handler
function popup2(){
    var popupUsers = document.getElementById('userContainer');

    if(popupUsers.style.display === 'none'){
        popupUsers.style.display = 'block';
    } else if(popupUsers.style.display === 'block'){
        popupUsers.style.display = 'none';
    } else{
        popupUsers.style.display = 'none';
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


// warranty
function showWarranty() {
    document.getElementById('warrantyContainer').style.display = 'block';
}

function closeWarranty() {
    document.getElementById('warrantyContainer').style.display = 'none';
}

// selecting unit to report
function popup(){
    var popupUnit = document.querySelector('.unitContainer');

    if(popupUnit.style.display === 'none'){
        popupUnit.style.display = 'block';
    } else if (popupUnit.style.display === 'none'){
        popupUnit.style.display = 'none';
    } else{
        popupUnit.style.display = 'none';
    }
}

function popup1(){
    var selectButton = document.getElementById('selectButton');
    var unit = document.getElementById('unit');
    var popupUnit1 = document.querySelector('.unitContainer');

    if(selectButton.style.display === 'none'){
        selectButton.style.display = 'block';
        popupUnit1.style.display = 'block';
        unit.style.display = 'none'
    } else if(selectButton.style.display === 'block'){
        selectButton.style.display = 'none';
        popupUnit1.style.display = 'none';
        unit.style.display = 'block'
    } else{
        selectButton.style.display = 'none';
        unit.style.displa = 'block'
    }
}

// history view equip
function history(){
    var popupContainer = document.querySelector('.container3');

    if(popupContainer.style.display === 'none'){
        popupContainer.style.display = 'block';
    } else if(popupContainer.style.display === 'block'){
        popupContainer.style.display = 'none';
    } else{
        popupContainer.style.display = 'none';
    }
}

// units
function showFilterPopup() {
    const popupContainer = document.getElementById('filterPopupContainer');
    popupContainer.style.display = 'flex';
}

function hideFilterPopup() {
    const popupContainer = document.getElementById('filterPopupContainer');
    popupContainer.style.display = 'none';
}

// report list
function toggleDropdown(element) {
    const dropdownContainer = element.querySelector('.dropdownContainer');
    if (dropdownContainer.style.display === 'none') {
      dropdownContainer.style.display = 'block';
    } else {
      dropdownContainer.style.display = 'none';
    }
  }
  

//   dashboard label
function enableEditMode() {
    const headerText = document.getElementById('headerText');
    const editIcon = document.querySelector('.edit-icon');

    headerText.contentEditable = true;
    headerText.focus();
    editIcon.style.display = 'none';

    headerText.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            headerText.contentEditable = false;
            editIcon.style.display = 'inline';
            saveHeaderText(headerText.innerHTML);
        }
    });
}

function saveHeaderText(text) {
    localStorage.setItem('headerText', text);
}

function getHeaderText() {
    return localStorage.getItem('headerText');
}

window.addEventListener('DOMContentLoaded', function () {
    const headerText = getHeaderText();
    if (headerText) {
        document.getElementById('headerText').innerHTML = headerText;
    }
});


// go back
function goBack() {
    window.history.back();
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