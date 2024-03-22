function popupForm(){
    var popup = document.querySelector(".editProfileContainer");

    if(popup.style.display === 'none'){
        popup.style.display = 'block';
    } else {
        popup.style.display = 'none'
    }
}

document.getElementById('fileButton').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function() {
    var selectedFile = this.files[0];
    // Do something with the selected file, such as reading its contents
    console.log('Selected file:', selectedFile);
});
