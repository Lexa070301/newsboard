$(document).ready(function () {
    var last_news = new Swiper ('.last_news-container', {
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
});