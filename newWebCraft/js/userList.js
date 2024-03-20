function popUp2(){
    var popUp = document.querySelector('.addUserContainer');

    if(popUp.style.display === 'none'){
        popUp.style.display = 'block';
    } else if(popUp.style.display === 'block'){
        popUp.style.display = 'none';
    } else{
        popUp.style.display = 'none';
    }
}