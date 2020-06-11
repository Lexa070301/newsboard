<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Keywords" content="новости, политика, экономика, спорт, news board">
    <meta name="description" content="Актуальные новости со всего света, собраные вместе для удобного восприятия.">

    <title>News Board - Главная</title>
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/swiper.min.css">
    <link rel="stylesheet" href="css/remodal.css">
    <link rel="stylesheet" href="css/remodal-default-theme.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
    <div class="container">
        <a href="./" class="header__logo">
            <img class="header__logo__img" src="img/logo.png" alt="Логотип" title="News Board">
        </a>
        <div class="overlay menu-wrap">
            <nav class="menu overlayMenu">
                <ul class="menu__list" role="menu">
                    <li class="menu__list__item">
                        <a href="./" class="menu__list__item__link" role="menuitem">Главная</a>
                    </li>
                    <li class="menu__list__item">
                        <a href="./politics" class="menu__list__item__link" role="menuitem">Политика</a>
                    </li>
                    <li class="menu__list__item">
                        <a href="./economy" class="menu__list__item__link" role="menuitem">Экономика</a>
                    </li>
                    <li class="menu__list__item">
                        <a href="./sport" class="menu__list__item__link" role="menuitem">Спорт</a>
                    </li>
                </ul>
            </nav>
            <div class="cabinet-mobile">
                <button class="cabinet__btn cabinet__registration">Зарегистрироваться</button>
                <button class="cabinet__btn cabinet__enter">Войти</button>
                <a href="./cabinet" class="cabinet__link">
                    <img src="img/icons/user.svg" alt="Личный кабинет">
                </a>
                <div class="cabinet__registration-modal" data-remodal-id="cabinet__registration__modal">
                    <div class="cabinet__modal__container">
                        <h2 class="cabinet__modal__title">Регистрация</h2>
                        <form action="./" method="post" class="cabinet__modal__from cabinet__registration__form">
                            <input required type="text" name="name" class="name form-input" placeholder="Ваше имя">
                            <input required type="email" name="email" class="email form-input" placeholder="Ваш E-mail"
                                   pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$">
                            <input required type="password" name="password" class="password form-input"
                                   placeholder="Введите пароль">
                            <input required type="password" name="password2" class="password form-input"
                                   placeholder="Повторите пароль">
                            <input disabled class="remodal-confirm" type="submit" value="Зарегистрироваться">
                        </form>
                    </div>
                    <a class="remodal-cancel" href="#">х</a>
                </div>
                <div class="cabinet__enter-modal" data-remodal-id="cabinet__enter__modal">
                    <div class="cabinet__modal__container">
                        <h2 class="cabinet__modal__title">Вход</h2>
                        <form action="./" method="post" class="cabinet__modal__from cabinet__enter__form">
                            <input required type="email" name="email" class="email form-input" placeholder="Ваш E-mail"
                                   pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$">
                            <input required type="password" name="password" class="password form-input"
                                   placeholder="Введите пароль">
                            <input disabled class="remodal-confirm" type="submit" value="Войти">
                        </form>
                    </div>
                    <a class="remodal-cancel" href="#">х</a>
                </div>
            </div>
        </div>

        <div class="cabinet">
            <button class="cabinet__btn cabinet__registration">Зарегистрироваться</button>
            <button class="cabinet__btn cabinet__enter">Войти</button>
            <a href="./cabinet" class="cabinet__link">
                <img src="img/icons/user.svg" alt="Личный кабинет">
            </a>
            <div class="cabinet__registration-modal" data-remodal-id="cabinet__registration__modal">
                <div class="cabinet__modal__container">
                    <h2 class="cabinet__modal__title">Регистрация</h2>
                    <form action="./" method="post" class="cabinet__modal__from cabinet__registration__form">
                        <input required type="text" name="name" class="name form-input" placeholder="Ваше имя">
                        <input required type="email" name="email" class="email form-input" placeholder="Ваш E-mail"
                               pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$">
                        <input required type="password" name="password" class="password form-input"
                               placeholder="Введите пароль">
                        <input required type="password" name="password2" class="password form-input"
                               placeholder="Повторите пароль">
                        <input disabled class="remodal-confirm" type="submit" value="Зарегистрироваться">
                    </form>
                </div>
                <a class="remodal-cancel" href="#">х</a>
            </div>
            <div class="cabinet__enter-modal" data-remodal-id="cabinet__enter__modal">
                <div class="cabinet__modal__container">
                    <h2 class="cabinet__modal__title">Вход</h2>
                    <form action="./" method="post" class="cabinet__modal__from cabinet__enter__form">
                        <input required type="email" name="email" class="email form-input" placeholder="Ваш E-mail"
                               pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$">
                        <input required type="password" name="password" class="password form-input"
                               placeholder="Введите пароль">
                        <input disabled class="remodal-confirm" type="submit" value="Войти">
                    </form>
                </div>
                <a class="remodal-cancel" href="#">х</a>
            </div>
        </div>
        <div class="navBurger" role="navigation" id="navToggle"></div>
    </div>
</header>
<main class="post-main">
    <section class="post">
        <div class="container">
            <h1 class="post__main-title">
                Число случаев заражения коронавирусом в мире привысило 7 миллионов
            </h1>
            <div class="post__date-and-author">
                <span class="post__date">11.06.2020</span>
                <span class="post__author">Василий Васильевич Пупкин</span>
            </div>
            <img src="img/news/img1.webp" class="post__img" alt="Картинка новости">
            <p class="post__text">
                Число случаев заражения коронавирусом нового типа в мире превысило 7,1 миллиона, свыше 408 тысяч человек
                с COVID-19 скончались, сообщает Всемирная организация здравоохранения (ВОЗ).
                Согласно последним данным организации, за сутки зарегистрирован 105 621 новый случай заболевания
                COVID-19, умерли 3 629 пациентов. Таким образом, общее число выявленных случаев COVID-19 в мире
                составляет 7 145 539, количество летальных исходов - 408 025. Всемирная организация здравоохранения 11
                марта объявила вспышку новой коронавирусной инфекции COVID-19 пандемией.
            </p>
        </div>
    </section>
    <section class="last-news">
        <div class="container">
            <h2 class="post__title">Последние новости</h2>
            <ul class="post__last-news">
                <li class="post__last-news__item" style="background: url('img/news/img2.webp') center
                center no-repeat; background-size: cover">
                    <a href="#" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            США собираются "подарить" Германию России
                        </h3>
                    </a>
                </li>
                <li class="post__last-news__item" style="background: url('img/news/img3.webp') center
                center no-repeat; background-size: cover">
                    <a href="#" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            Диетолог рассказала, как правильно выбрать хлеб
                        </h3>
                    </a>
                </li>
                <li class="post__last-news__item" style="background: url('img/news/img4.webp') center
                center no-repeat; background-size: cover">
                    <a href="#" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            С Днем океанов! Красота, ужас и загадки обитателей глубин
                        </h3>
                    </a>
                </li>
                <li class="post__last-news__item" style="background: url('img/news/img5.webp') center
                center no-repeat; background-size: cover">
                    <a href="#" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            Сам себе фотограф: как организовать профессиональную съемку дома
                        </h3>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</main>
<footer>
    <div class="container">
        <a class="footer__privacy-policy">Политика конфеденциальности</a>
        <a href="./" class="footer__logo">
            <img class="footer__logo__img" src="img/logo.png" alt="Логотип" title="News Board">
        </a>
        <span class="footer__rights">2020 @ Все права защищены</span>
    </div>
</footer>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/remodal.min.js"></script>
<script src="js/drawer.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>