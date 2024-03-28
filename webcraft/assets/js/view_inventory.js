function changeColor(button) {
    var filters = document.querySelectorAll('.equipment');
    filters.forEach(function(filter) {
        filter.style.backgroundColor = '';
    });

    button.style.backgroundColor = 'gray'; 
}