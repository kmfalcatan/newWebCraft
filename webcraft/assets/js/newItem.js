var selectedUsers = []; 

function dropdown() {
  var dropdownContainer = document.getElementById('dropdown');

  if (dropdownContainer.style.display === 'none') {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        dropdownContainer.innerHTML = xhr.responseText;
      }
    };
    xhr.open('GET', '/get_users.php', true);
    xhr.send();

    dropdownContainer.style.display = 'block';
  } else {
    dropdownContainer.style.display = 'none';
  }
}

function viewSelectedUsers() {
  var dropdownContainer = document.getElementById('dropdown1');
  var selectedUsersContainer = document.getElementById('selectedUsersContainer');

  if (dropdownContainer.style.display === 'none') {
    dropdownContainer.style.display = 'block';
  } else {
    dropdownContainer.style.display = 'none';
  }
}

function handleUserSelection(checkbox, username) {
  if (checkbox.checked) {

    selectedUsers.push(username);
  } else {

    var index = selectedUsers.indexOf(username);
    if (index !== -1) {
      selectedUsers.splice(index, 1);
    }
  }

  var selectedUsersDropdown = document.getElementById('selectedUsersContainer');
  selectedUsersDropdown.innerHTML = '';

  for (var i = 0; i < selectedUsers.length; i++) {
    var pElement = document.createElement('p');
    pElement.textContent = selectedUsers[i];
    selectedUsersDropdown.appendChild(pElement);
  }
}

// distribution of units
var unitsData = {}; 

function dropdown2() {
    var dropdownContainer = document.getElementById('dropdown');
    var dropdownContainer1 = document.getElementById('dropdown2');
    var selectedUsersContainer = document.getElementById('selectedUsersContainer2');

    if (dropdownContainer1.style.display === 'none') {
        dropdownContainer1.style.display = 'block';
    } else {
        dropdownContainer1.style.display = 'none';
    }

    if (dropdownContainer1.style.display === 'block') {
        selectedUsersContainer.innerHTML = '';

        for (var i = 0; i < selectedUsers.length; i++) {
            var divElement = document.createElement('div');
            divElement.classList.add('subDropDownContainer1');

            var checkbox = document.createElement('input');
            checkbox.classList.add('checkBox');
            checkbox.type = 'checkbox';
            checkbox.checked = true; 
            checkbox.name = 'user[]'; 
            checkbox.value = selectedUsers[i]; 
            divElement.appendChild(checkbox);

            var pElement = document.createElement('p');
            pElement.textContent = selectedUsers[i];
            divElement.appendChild(pElement);

            var unitInput = document.createElement('input');
            unitInput.classList.add('unit');
            unitInput.style.width = '3rem';
            unitInput.style.marginRight = '0.5rem';
            unitInput.style.textAlign = 'center';
            unitInput.type = 'number';
            unitInput.name = 'units_handled[]'; 
            unitInput.placeholder = 'Unit:';

            if (unitsData[selectedUsers[i]] !== undefined) {
                unitInput.value = unitsData[selectedUsers[i]];
            }
            divElement.appendChild(unitInput);

            selectedUsersContainer.appendChild(divElement);
        }
    }
}

function saveUnits() {
    var unitInputs = document.querySelectorAll('.unit');
    var totalUnits = 0;
    unitInputs.forEach(function(unitInput) {
        var username = unitInput.previousSibling.textContent;
        unitsData[username] = unitInput.value; 
        totalUnits += parseInt(unitInput.value) || 0; 
    });
    document.getElementById('totalUnits').value = totalUnits; 
    document.getElementById('dropdown2').style.display = 'none';
}

// total value
document.addEventListener("DOMContentLoaded", function () {
  const unitValueInput = document.querySelector('input[name="unit_value"]');
  const totalUnitInput = document.getElementById('totalUnits');
  const totalValueInput = document.querySelector('input[name="total_value"]');

  unitValueInput.addEventListener('input', function () {
      const unitValue = parseFloat(unitValueInput.value.replace(/,/g, '')) || 0;
      const totalUnit = parseFloat(totalUnitInput.value) || 0;
      const totalValue = unitValue * totalUnit;

      totalValueInput.value = numberWithCommas(totalValue.toFixed(2)); 
  });

  function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
});

// year

document.addEventListener("DOMContentLoaded", function () {
  const propertyNumberInput = document.querySelector('input[name="property_number"]');
  const yearReceivedInput = document.getElementById('select-year');

  propertyNumberInput.addEventListener('input', function () {
      const propertyNumberValue = propertyNumberInput.value.trim();
      const regex = /ICS-(\d{2})-.*/; 
      const match = propertyNumberValue.match(regex);
      if (match) {
          let year = parseInt(match[1]);
          if (year < 20) {
              year += 2000; 
          } else if (year < 100) {
              year += 2000;
          }
          yearReceivedInput.value = year;
      } else {
          yearReceivedInput.value = ""; 
      }
  });
});

  function appear(){
      var popup = document.querySelector('.modal');

      if(popup.style.display === 'none'){
          popup.style.display = 'block';
      } else if(popup.style.display === 'block'){
          popup.style.display = 'none';
      } else{
          popup.styl.display = 'none';
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

 // *Copyright  © 2024 WebCraft - All Rights Reserved*
    // *Administartive Office Facility Reservation and Management System*
    // *IT 132 - Software Engineering *
    // *(WebCraft) Members:
        // Falcatan, Khriz Marr
        // Gabotero, Rogie
        // Taborada, John Mark
        // Tingkasan, Padwa 
        // Villares, Arp-J*