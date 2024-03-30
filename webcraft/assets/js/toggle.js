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

// report options
document.getElementById("dropdownContent").style.display = "none";

function toggleDropdown() {
    var dropdownContent = document.getElementById("dropdownContent");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none"; 
    } else {
        dropdownContent.style.display = "block"; 
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var agreementCheckbox = document.getElementById("agreementCheckbox");
    var proceedButton = document.querySelector(".proceed");

    function toggleButtonState() {
        proceedButton.disabled = !agreementCheckbox.checked;
        if (proceedButton.disabled) {
            proceedButton.style.backgroundColor = "rgba(2, 117, 200, 0.297)";
        } else {
            proceedButton.style.backgroundColor = ""; 
        }
    }

    toggleButtonState();

    agreementCheckbox.addEventListener("change", toggleButtonState);
});



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
  