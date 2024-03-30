document.getElementById('fileButton').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function() {
    var selectedFile = this.files[0];
    // Do something with the selected file, such as reading its contents
    console.log('Selected file:', selectedFile);
});


function popupForm(){
    var editForm = document.querySelector('.editProfileContainer');

    if (editForm.style.display === 'none'){
        editForm.style.display = 'block';
    } else{
        editForm.style.display = 'none';
    }
}