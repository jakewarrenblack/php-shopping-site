let mainNav = document.getElementById('js-menu');
let navContainer = document.getElementById('nav');
let navBarToggle = document.getElementById('js-navbar-toggle');
let APP_URL = 'http://localhost/awdd/SWP-CA2';

let registerElement = document.getElementsByClassName('register__element');

let sign_in = document.getElementById('sign_in');
let register = document.getElementById('register');
let form = document.getElementById("signin_register_form")

navBarToggle.addEventListener('click', function () {
    mainNav.classList.toggle('active');
    navContainer.classList.toggle('zeroShrink');
});

if(sign_in != null){
    sign_in.addEventListener('click',function(){
        for (i = 0; i < registerElement.length; i++) {
            registerElement[i].classList.remove('visible');
            sign_in.classList.add('form_btn_active');
            register.classList.remove('form_btn_active');
            form.action = APP_URL + "/actions/login.php";
          } 
    }); 
}

if(register != null){
    register.addEventListener('click',function(){
        for (i = 0; i < registerElement.length; i++) {
            registerElement[i].classList.add('visible');
            register.classList.add('form_btn_active');
            sign_in.classList.remove('form_btn_active');
            form.action = APP_URL + "/actions/register.php";
          } 
    });  
}

window.addEventListener('scroll', function () {
    if(window.innerWidth > 1400){
        if (document.documentElement.scrollTop > 400) {
            document.getElementById("logo").style.width = "4rem";
            document.getElementById("js-menu").style.fontSize = "1rem";
        }
        if(document.documentElement.scrollTop < 400){
            document.getElementById("js-menu").style.fontSize = "var(--step--1)";
            document.getElementById("logo").style.width = "6rem";
        }
    }
});

window.addEventListener('load', function (event) {
    const customer_delete_btn = document.getElementsByClassName('btn-customer-delete')[0];
    customer_delete_btn.addEventListener("click", function (event) {
    if (!confirm("Are you sure you want to delete this customer?")) {
        event.preventDefault();
    }
    });
});


