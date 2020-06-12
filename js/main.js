if (typeof Dropzone == 'function') {
    Dropzone.autoDiscover = false;
}
$(document).ready(function () {
    $('.drawer').drawer();
    if (typeof Dropzone == 'function') {
        var myDropzone = new Dropzone('#add-new-file', {
            url: './',
            method: 'post',
            maxFiles: 1,
            dictFallbackMessage: 'Не поддерживается вашим браузером',
            dictFileTooBig: 'Размер файла слишком велик',
            dictInvalidFileType: 'Неправильный тип файла',
            acceptedFiles: 'image/webp',
            addRemoveLinks: true,
        });
        myDropzone._updateMaxFilesReachedClass()
        myDropzone.on('maxfilesreached', function () {
            myDropzone.removeEventListeners();
        });
        myDropzone.on('removedfile', function (file) {
            myDropzone.setupEventListeners();
        });
    }
    $('.dz-button').text('Перетащите картинку сюда');
    $('ul.tabs__caption').on('click', 'li:not(.active)', function () {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.tabs').find('.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
    });
    $("#navToggle").click(function () {
        $(this).toggleClass("active");
        $(".overlay").toggleClass("open");
        // this line ▼ prevents content scroll-behind
        $("body").toggleClass("locked");
    });
    $('.overlay').click(function () {
        $(this).removeClass('open');
        $("body").toggleClass("locked");
        $('.navBurger').removeClass('active');
    });
    if (typeof Swiper == 'function') {
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
    }
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
        if (($('.cabinet__enter__form [type="email"]').val() != '') && ($('.cabinet__enter__form [type="password"]').val() != '')) {
            $('.cabinet__enter__form .remodal-confirm').removeAttr("disabled");
        }
    });
});