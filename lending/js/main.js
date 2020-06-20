$(document).ready(function () {
    var scene = document.getElementById('scene');
    var parallaxInstance = new Parallax(scene);
    new WOW().init();
    $('.header__menu__link, .footer__logo').on( 'click', function(){
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
    var $grid = $('.gallery__grid').masonry({
        gutter: 30,
        itemSelector: '.gallery__grid__item',
        fitWidth: true
    });
    if (typeof $grid.imagesLoaded == 'function') {
        $grid.imagesLoaded().progress(function () {
            $grid.masonry('layout');
        });
    }
});