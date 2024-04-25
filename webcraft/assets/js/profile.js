// profile image 
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('fileButton').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function() {
        var selectedFile = this.files[0];

        if (selectedFile.size >  2 * 1024 * 1024) {
            var modal = document.getElementById("ImgsizeModal");
            modal.style.display = "block";
            return; 
        }

        var reader = new FileReader();
        reader.onload = function(event) {
            var previewImage = document.getElementById('previewImage');
            previewImage.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    });

    document.querySelector('.close').addEventListener('click', function() {
        var modal = document.getElementById("ImgsizeModal");
        modal.style.display = "none";
        location.reload(); 
    });
});

// 
function popupForm(){
    var editForm = document.querySelector('.editProfileContainer');

    if (editForm.style.display === 'none'){
        editForm.style.display = 'block';
    } else{
        editForm.style.display = 'none';
    }
}

function popupForm1(){
    var editForm = document.querySelector('.changepassContainer');

    if (editForm.style.display === 'none'){
        editForm.style.display = 'block';
    } else{
        editForm.style.display = 'none';
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