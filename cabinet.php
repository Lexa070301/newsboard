<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>News Board - Личный кабинет</title>
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/remodal.css">
    <link rel="stylesheet" href="css/remodal-default-theme.css">
    <link rel="stylesheet" href="css/dropzone.min.css">
    <link rel="stylesheet" href="css/drawer.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="drawer drawer--left">
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
                <a href="#" class="cabinet__link">
                    <img src="img/icons/user.svg" alt="Личный кабинет">
                </a>
            </div>
        </div>
        <div class="cabinet">
            <a href="#" class="cabinet__link">
                <img src="img/icons/user.svg" alt="Личный кабинет">
            </a>
        </div>
        <div class="navBurger" role="navigation" id="navToggle"></div>
    </div>
</header>
<main class="cabinet-main tabs">
    <button type="button" class="drawer-toggle drawer-hamburger">
        <span class="sr-only">toggle navigation</span>
        <span class="drawer-hamburger-icon"></span>
    </button>
    <div class="drawer-nav" role="navigation">
        <ul class="drawer-menu tabs__caption">
            <li class="active">Учетная запись</li>
            <li>Предложить новость</li>
        </ul>
    </div>
    <aside class="cabinet-main__sidebar">
        <ul class="tabs__caption">
            <li class="active">Учетная запись</li>
            <li>Предложить новость</li>
        </ul>
    </aside>
    <div class="cabinet-main__content">
        <h1 class="tabs__content__main-title">Добро пожаловать, [Name]</h1>
        <div class="tabs__content active">
            <form action="./" method="post" class="cabinet-main__content__form">
                <div class="cabinet-main__content__form__left">
                    <h2>Сменить имя:</h2>
                    <label for="new-name">Ваше новое имя:</label>
                    <input type="text" name="new-name" id="new-name" class="form-input" placeholder="Ваше новое имя">
                    <h2>Сменить email:</h2>
                    <label for="new-email">Ваш новый E-mail:</label>
                    <input type="email" name="new-email" id="new-email" class="form-input" placeholder="Ваш новый e-mail">
                    <input type="submit" value="Сохранить" class="cabinet-main__content__form__save">
                </div>
                <div class="cabinet-main__content__form__right">
                    <h2>Сменить пароль:</h2>
                    <label for="old-password">Введите ваш старый пароль:</label>
                    <input type="password" name="old-password" id="old-password" class="form-input"
                           placeholder="Ваше старый пароль">
                    <label for="new-password">Придумайте новый пароль:</label>
                    <input type="password" name="new-password" id="new-password" class="form-input"
                           placeholder="Ваш новый пароль">
                    <label for="new-password2">Повторите новый пароль:</label>
                    <input type="password" name="new-password2" id="new-password2" class="form-input"
                           placeholder="Ваш новый пароль">
                </div>
            </form>
        </div>
        <div class="tabs__content">
            <h2>Предложить новость:</h2>
            <form action="./" method="post" id="add-new" class="add-new">
                <label for="add-new-title">Заголовок (Максимум 60 символов)<span>*</span>:</label>
                <input type="text" maxlength="60" name="add-new-title" id="add-new-title" class="form-input"
                       placeholder="Заголовок новости">
                <label for="add-new-text">Текст<span>*</span>:</label>
                <textarea placeholder="Текст новости" name="add-new-text" id="add-new-text"
                          class="form-input"></textarea>
                <label for="add-new-file">Загрузите картинку:</label>
                <div class="dropzone" id="add-new-file"></div>
                <input type="submit" value="Отправить" class="add-new-send">
            </form>
        </div>
    </div>
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
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/remodal.min.js"></script>
<script src="js/dropzone.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/iscroll.min.js"></script>
<script src="js/drawer.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>