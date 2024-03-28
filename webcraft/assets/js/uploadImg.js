document.addEventListener('DOMContentLoaded', function () {
    var uploadButton1 = document.getElementById('image');
    var uploadImage1 = document.getElementById('image3');

    uploadButton1.addEventListener('change', function (event) {
      if (event.target.files.length > 0) {
        var selectedImage1 = event.target.files[0];
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
        var imageURL2 = URL.createObjectURL(selectedImage2);

        uploadImage2.src = imageURL2;
      } else {
        uploadImage2.src = '../assets/img/img_placeholder.jpg';
      }
    });
  });