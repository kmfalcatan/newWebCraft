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

// end user unit
function filterTable() {
    var searchTerm = document.querySelector(".searchBar1").value.trim().toLowerCase();

    var rows = document.querySelectorAll("#tblBody tr");
    var noResultsMessage = document.querySelector(".noResultsFound");

    var found = false;

    rows.forEach(function(row) {
        var unitID = row.querySelector("td:nth-child(2)").textContent.toLowerCase(); 
        var article = row.querySelector("td:nth-child(3)").textContent.toLowerCase(); 
        var propertyNumber = row.querySelector("td:nth-child(4)").textContent.toLowerCase(); 
        var accountCode = row.querySelector("td:nth-child(5)").textContent.toLowerCase(); 
        var remarks = row.querySelector("td:nth-child(6)").textContent.toLowerCase(); 

        if (unitID.includes(searchTerm) || article.includes(searchTerm) || propertyNumber.includes(searchTerm) || accountCode.includes(searchTerm) || remarks.includes(searchTerm)) {
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

 // *Copyright  © 2024 WebCraft - All Rights Reserved*
    // *Administartive Office Facility Reservation and Management System*
    // *IT 132 - Software Engineering *
    // *(WebCraft) Members:
        // Falcatan, Khriz Marr
        // Gabotero, Rogie
        // Taborada, John Mark
        // Tingkasan, Padwa 
        // Villares, Arp-J*