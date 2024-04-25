// new item image 
  document.addEventListener('DOMContentLoaded', function () {
    var uploadButton1 = document.getElementById('image');
    var uploadImage1 = document.getElementById('image3');

    uploadButton1.addEventListener('change', function (event) {
        if (event.target.files.length > 0) {
            var selectedImage1 = event.target.files[0];

            if (selectedImage1.size > 2 * 1024 * 1024) {
                var modal = document.getElementById("ImgsizeModal");
                modal.style.display = "block";
                return;
            }

            var imageURL1 = URL.createObjectURL(selectedImage1);

            uploadImage1.src = imageURL1;
        } else {
            uploadImage1.src = '../assets/img/img_placeholder.jpg';
        }
    });

    var uploadButton1 = document.getElementById('warranty_image');
    var uploadImage2 = document.getElementById('image4');

    uploadButton1.addEventListener('change', function (event) {
        if (event.target.files.length > 0) {
            var selectedImage2 = event.target.files[0];

            if (selectedImage2.size > 2 * 1024 * 1024) {
                var modal = document.getElementById("ImgsizeModal");
                modal.style.display = "block";
                return;
            }

            var imageURL2 = URL.createObjectURL(selectedImage2);

            uploadImage2.src = imageURL2;
        } else {
            uploadImage2.src = '../assets/img/img_placeholder.jpg';
        }
    });

    document.querySelector('.close').addEventListener('click', function() {
      var modal = document.getElementById("ImgsizeModal");
      modal.style.display = "none";
      location.reload(); 
  });
  
});


document.querySelector('.closebtn').addEventListener('click', function() {
  var modal = document.getElementById("ImgsizeModal");
  modal.style.display = "none";
  location.reload(); 
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