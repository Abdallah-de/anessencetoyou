var wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

/* const btnPopup = document.querySelector('.btnLogin-popup'); */

const iconClose = document.querySelector('.icon-close');

/* btnPopup.addEventListener('click', ()=>{
    wrapper.classList.add('active-popup');
}); */

iconClose.addEventListener('click', ()=>{
    wrapper.classList.remove('active-popup');
}); 

document.addEventListener('DOMContentLoaded', function() {
    var welcomeText = document.getElementById('welcomeText');
    var btnLoginPopup = document.querySelector('.btnLogin-popup');

    btnLoginPopup.addEventListener('click', function() {
        welcomeText.style.opacity = '0';
        setTimeout(function() {
            welcomeText.style.display = 'none';
        }, 1000);
    });
});