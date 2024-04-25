


// search bar unit list
function filterTable() {
    var searchTerm = document.querySelector(".searchBar1").value.toLowerCase();

    var rows = document.querySelectorAll("#tblBody tr");
    var noResultsMessage = document.querySelector(".noResultsFound");

    var found = false;

    rows.forEach(function(row) {
        var article = row.querySelector("td:nth-child(2)").textContent.toLowerCase(); 
        var description = row.querySelector("td:nth-child(3)").textContent.toLowerCase(); 
        var propertyNumber = row.querySelector("td:nth-child(4)").textContent.toLowerCase(); 
        var accountCode = row.querySelector("td:nth-child(5)").textContent.toLowerCase(); 
        var totalUnit = row.querySelector("td:nth-child(6)").textContent.toLowerCase(); 
        var yearReceived = row.querySelector("td:nth-child(7)").textContent.toLowerCase(); 

        if (article.indexOf(searchTerm) > -1 || description.indexOf(searchTerm) > -1 || propertyNumber.indexOf(searchTerm) > -1 || accountCode.indexOf(searchTerm) > -1 || totalUnit.indexOf(searchTerm) > -1 || yearReceived.indexOf(searchTerm) > -1) {
            row.style.display = ""; 
            found = true;
        } else {
            row.style.display = "none"; 
        }
    });

    if (found) {
        noResultsMessage.style.display = "none";
    } else {
        noResultsMessage.style.display = "block";
    }
}

document.querySelector(".searchBar1").addEventListener("input", filterTable);

// notification end user
const inbox = document.getElementById('inbox');

    inbox.addEventListener('click', function() {
        const items = document.querySelectorAll('#notification-list li');

        items.forEach(item => {
            if (item.classList.contains('approved') || item.classList.contains('transfer')) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    const outbox = document.getElementById('outbox');

    outbox.addEventListener('click', function() {
        const items = document.querySelectorAll('#notification-list li');

        items.forEach(item => {
            if (item.classList.contains('unit')) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    const myNotification = document.querySelector('.menu li');

    myNotification.addEventListener('click', function() {
        const items = document.querySelectorAll('#notification-list li');

        items.forEach(item => {
            item.style.display = 'block';
        });
    });

    // *Copyright  © 2024 WebCraft - All Rights Reserved*
    // *Administartive Office Facility Reservation and Management System*
    // *IT 132 - Software Engineering *
    // *(WebCraft) Members:
        // Falcatan, Khriz Marr
        // Gabotero, Rogie
        // Taborada, John Mark
        // Tingkasan, Padwa 
        // Villares, Arp-J*