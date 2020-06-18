$(document).ready(function () {
    var scene = document.getElementById('scene');
    var parallaxInstance = new Parallax(scene);
    var img_scene = document.getElementById('goal__img-scene');
    var parallaxInstance = new Parallax(img_scene);
    new WOW().init();
    $('.header__menu__link').on( 'click', function(){
        var el = $(this);
        var dest = el.attr('href'); // получаем направление
        if(dest !== undefined && dest !== '') { // проверяем существование
            $('html').animate({
                    scrollTop: $(dest).offset().top // прокручиваем страницу к требуемому элементу
                }, 1000 // скорость прокрутки
            );
        }
        return false;
    });
});