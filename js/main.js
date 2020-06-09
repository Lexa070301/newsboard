$(document).ready(function () {
    $("#navToggle").click(function() {
        $(this).toggleClass("active");
        $(".overlay").toggleClass("open");
        // this line ▼ prevents content scroll-behind
        $("body").toggleClass("locked");
    });
    $('.overlay').click(function() {
        $(this).removeClass('open');
        $("body").toggleClass("locked");
        $('.navBurger').removeClass('active');
    });
    var last_news = new Swiper('.last_news-container', {
        direction: 'horizontal',
        loop: true,
        navigation: {
            nextEl: '.last_news-next',
            prevEl: '.last_news-prev',
        },
        autoplay: {
            delay: 5000,
        }
    });
    $('.board__grid').masonry({
        itemSelector: '.board__grid__item',
        columnWidth: 300,
        gutter: 30,
        fitWidth: true
    });
    $('.cabinet__registration').on('click', function () {
        $('[data-remodal-id=cabinet__registration__modal]').remodal().open();
    });
    $('.cabinet__enter').on('click', function () {
        $('[data-remodal-id=cabinet__enter__modal]').remodal().open();
    });
    $('[type="password"]').on('keyup', function () {
        if ($('.cabinet__registration__form [name="password"]').val() == $('.cabinet__registration__form' +
            ' [name="password2"]').val()) {
            $('.cabinet__registration__form [type="password"]').removeClass('red-border');

        } else {
            $('.cabinet__registration__form [type="password"]').addClass('red-border');
        }
    });
    $('.cabinet__registration__form .form-input').on('keyup', function () {
        if (($('.cabinet__registration__form [name="name"]').val() != '') && ($('#cabinet__registration__form' +
            ' [name="email"]').val() != '') && ($('.cabinet__registration__form [name="password"]').val() != '') && ($('.cabinet__registration__form [name="password2"]').val() != '') && ($('.cabinet__registration__form [name="password"]').val() == $('.cabinet__registration__form [name="password2"]').val())) {
            $('.cabinet__registration__form .remodal-confirm').removeAttr("disabled");
        }
    });
    $('.cabinet__enter__form .form-input').on('keyup', function () {
        if (($('.cabinet__enter__form [name="email"]').val() != '') && ($('.cabinet__enter__form [name="password"]').val() != '')) {
            $('.cabinet__enter__form .remodal-confirm').removeAttr("disabled");
        }
    });
});