
    var main_img = document.getElementById('main-img');
    var slider = document.getElementsByClassName('flickity-slider');
    var changers = document.querySelectorAll('.related-changer');
    var main_related = document.getElementById('main-related');
    var img;
    
    changers.forEach(function(image) {
        image.addEventListener('click',function(){
            main_related.classList.remove('d-none');
            main_img.src = image.src;
        });
    });