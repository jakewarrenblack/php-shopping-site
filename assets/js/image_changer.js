
    var main_img = document.getElementById('main-img');
    var changers = document.querySelectorAll('.related-changer');
    var main_related = document.getElementById('main-related');
    
    changers.forEach(function(image) {
        image.addEventListener('click',function(){
            if(main_related!=null){
                main_related.classList.remove('d-none');
            }
            main_img.src = image.src;
        });
    });