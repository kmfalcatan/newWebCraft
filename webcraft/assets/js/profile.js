document.getElementById('fileButton').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function() {
    var selectedFile = this.files[0];
    console.log('Selected file:', selectedFile);
    
    var reader = new FileReader();
    reader.onload = function(event) {
        var previewImage = document.getElementById('previewImage');
        previewImage.src = event.target.result;
    };
    reader.readAsDataURL(selectedFile);
});


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