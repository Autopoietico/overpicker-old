let width677, headerNav, burgerButton;

function hamburgerValidation(){

    width677 = window.matchMedia('screen and (max-width: 677px)');
    headerNav = document.querySelector('.header-nav');
    burgerButton = document.getElementById('burger-menu');
    
    width677.addListener(validation);
    validation(width677);
}

function validation(event){

    if(event.matches){
        burgerButton.addEventListener('click', hideShow);
    }else{
        burgerButton.removeEventListener('click',hideShow);
    }
}

function hideShow(){
    if(headerNav.classList.contains('is-active')){
        headerNav.classList.remove('is-active');
    }else{
        headerNav.classList.add('is-active');
    }
}