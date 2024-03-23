

function track(){
    var container = document.querySelector('.trackButton');
    var popUp = document.querySelector('.subTrackContainer');
    var close = document.querySelector('.button3');

    if(popUp.style.display === 'none'){
        popUp.style.display = 'block';
    } else if(popUp.style.display === 'block'){
        popUp.style.display = 'none';
    } else{
        popUp.style.display = 'none';
    }
}

function track1(){
    var popUp = document.querySelector('.trackUnitContainer');

    if(popUp.style.display === 'none'){
        popUp.style.display = 'block';
    } else if(popUp.style.display === 'block'){
        popUp.style.display = 'none';
    } else{
        popUp.style.display = 'none';
    }
}

function track2(){
    var popUp1 = document.querySelector('.subUnitsContainer');

    if(popUp1.style.display === 'none'){
        popUp1.style.display = 'block';
    } else if(popUp1.style.display === 'block'){
        popUp1.style.display = 'none';
    } else{
        popUp1.style.display = 'none';
    }
}

function track3(){
    var popUp1 = document.querySelector('.viewUnitContainer');

    if(popUp1.style.display === 'none'){
        popUp1.style.display = 'block';
    } else if(popUp1.style.display === 'block'){
        popUp1.style.display = 'none';
    } else{
        popUp1.style.display = 'none';
    }
}