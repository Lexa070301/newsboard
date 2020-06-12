<?php
include('connect.php');
$news = mysqli_fetch_all(mysqli_query($database, 'SELECT * FROM news ORDER BY id'), MYSQLI_BOTH);
$post = mysqli_fetch_all(mysqli_query($database, 'SELECT news.id As id, title, name, date, text FROM news INNER JOIN users ON (author_id = users.id) WHERE news.id = ' . $_GET['id'] . ' ORDER BY news.id'), MYSQLI_BOTH);
$description = mysqli_fetch_all(mysqli_query($database, 'SELECT description FROM join_table INNER JOIN categories ON (category_id = categories.id) WHERE news_id = ' . $_GET['id'] . ' ORDER BY news_id'), MYSQLI_BOTH);
$keywords = mysqli_fetch_all(mysqli_query($database, 'SELECT keyword FROM join_table INNER JOIN categories ON (join_table.category_id = categories.id) INNER JOIN keywords ON (categories.id = keywords.category_id) WHERE news_id = ' . $_GET['id'] . ' ORDER BY keywords.category_id'), MYSQLI_BOTH);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Keywords" content="<?php
    for ($i = 0; $i < count($keywords); $i++) {
        if ($i == count($keywords) - 1)
            echo $keywords[$i]['keyword'];
        else
            echo $keywords[$i]['keyword'] . ', ';

    }
    ?>">
    <meta name="description" content=" <?php
    for ($i = 0; $i < count($description); $i++) {
        echo $description[$i]['description'] . ' ';
    }
    ?>">

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
                    <form action="./check.php" method="post" class="cabinet__modal__from cabinet__registration__form">
                        <input required type="text" name="name" minlength="4" maxlength="50" class="name form-input" placeholder="Ваше имя">
                        <input required type="email" name="email" class="email form-input" placeholder="Ваш E-mail">
                        <input required type="password" minlength="8" name="password" class="password form-input"
                               placeholder="Введите пароль">
                        <input required type="password" minlength="8" name="password2" class="password form-input"
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
                <?php
                if (isset($post[0]['title']))
                    echo $post[0]['title'];
                else {
                    echo '<br><br>' . 'Ошибка 404 "Страница не найдена"' . '<br><br>';
                }
                ?>
            </h1>
            <div class="post__date-and-author">
                <span class="post__date"><?php echo $post[0]['date'] ?></span>
                <span class="post__author"><?php echo $post[0]['name'] ?></span>
            </div>
            <?php
            if (isset($post[0]['id']))
                echo '<img src="img/news/img' . $post[0]['id'] . '.webp" class="post__img" alt="Картинка новости">';
            ?>
            <p class="post__text">
                <?php echo $post[0]['text'] ?>
            </p>
        </div>
    </section>
    <section class="last-news">
        <div class="container">
            <h2 class="post__title">Последние новости</h2>
            <ul class="post__last-news">
                <li class="post__last-news__item"
                    style="background: url('img/news/img<?php echo $news[0]['id'] ?>.webp') center
                            center no-repeat; background-size: cover">
                    <a href="./post?id=<?php echo $news[0]['id'] ?>" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            <?php echo $news[0]['title'] ?>
                        </h3>
                    </a>
                </li>
                <li class="post__last-news__item"
                    style="background: url('img/news/img<?php echo $news[1]['id'] ?>.webp') center
                            center no-repeat; background-size: cover">
                    <a href="./post?id=<?php echo $news[1]['id'] ?>" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            <?php echo $news[1]['title'] ?>
                        </h3>
                    </a>
                </li>
                <li class="post__last-news__item"
                    style="background: url('img/news/img<?php echo $news[2]['id'] ?>.webp') center
                            center no-repeat; background-size: cover">
                    <a href="./post?id=<?php echo $news[2]['id'] ?>" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            <?php echo $news[2]['title'] ?>
                        </h3>
                    </a>
                </li>
                <li class="post__last-news__item"
                    style="background: url('img/news/img<?php echo $news[3]['id'] ?>.webp') center
                            center no-repeat; background-size: cover">
                    <a href="./post?id=<?php echo $news[3]['id'] ?>" class="post__last-news__item__link">
                        <h3 class="post__last-news__item__title">
                            <?php echo $news[3]['title'] ?>
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