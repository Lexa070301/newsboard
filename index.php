<?php
include('connect.php');
$news = mysqli_fetch_all(mysqli_query($database, 'SELECT * FROM news ORDER BY id'), MYSQLI_BOTH);
?>
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
                    <li class="menu__list__item menu__list__item-active">
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
                    <form action="#" method="post" class="cabinet__modal__from cabinet__enter__form">
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
<main>
    <section class="last_news">
        <div class="container">
            <div class="last_news-container">
                <div class="swiper-wrapper">
                    <a href="./post?id=<?php echo $news[0]['id']?>" class="swiper-slide last_news__slide-1"
                       style="background: url('img/news/img<?php echo $news[0]['id']?>.webp') center center no-repeat;
                       background-size: cover">
                        <h2 class="last_news__slide__title">
                            <?php echo $news[0]['title'];?>
                        </h2>
                        <span class="last_news__date"><?php echo $news[0]['date'];?></span>
                    </a>
                    <a href="./post?id=<?php echo $news[1]['id']?>" class="swiper-slide last_news__slide-2"
                       style="background: url('img/news/img<?php echo $news[1]['id']?>.webp') center center no-repeat;
                       background-size: cover">
                        <h2 class="last_news__slide__title">
                            <?php echo $news[1]['title'];?>
                        </h2>
                        <span class="last_news__date"><?php echo $news[1]['date'];?></span>
                    </a>
                    <a href="./post?id=<?php echo $news[2]['id']?>" class="swiper-slide last_news__slide-3"
                       style="background: url('img/news/img<?php echo $news[2]['id']?>.webp') center center no-repeat;
                       background-size: cover">
                        <h2 class="last_news__slide__title">
                            <?php echo $news[2]['title'];?>
                        </h2>
                        <span class="last_news__date"><?php echo $news[2]['date'];?></span>
                    </a>
                </div>
                <div class="last_news-prev swiper-button-prev"></div>
                <div class="last_news-next swiper-button-next"></div>
            </div>
            <ul class="right_news">
                <li class="right_news__item">
                    <a href="./post?id=<?php echo $news[3]['id']?>" class="right_news__item__link">
                        <h3 class="right_news__item__link__title">
                            <?php echo $news[3]['title'];?>
                        </h3>
                        <span class="right_news__item__link__date"><?php echo $news[3]['date'];?></span>
                    </a>
                </li>
                <li class="right_news__item">
                    <a href="./post?id=<?php echo $news[4]['id']?>" class="right_news__item__link">
                        <h3 class="right_news__item__link__title">
                            <?php echo $news[4]['title'];?>
                        </h3>
                        <span class="right_news__item__link__date"><?php echo $news[4]['date'];?></span>
                    </a>
                </li>
                <li class="right_news__item">
                    <a href="./post?id=<?php echo $news[5]['id']?>" class="right_news__item__link">
                        <h3 class="right_news__item__link__title">
                            <?php echo $news[5]['title'];?>
                        </h3>
                        <span class="right_news__item__link__date"><?php echo $news[5]['date'];?></span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <section class="board">
        <div class="container">
            <div class="board__grid">
                <?php
                for ($i = 6; $i<10; $i++) {
                    echo '<a href="./post?id=' . $news[$i]['id'] . '" class="board__grid__item">';
                    if (($i % 2 == 0) || ($i % 3 == 0)) {
                        echo '<img src="img/news/img' . $news[$i]['id'] . '.webp" alt="Картинка новости" class="board__grid__item__img">';
                        echo '<h3 class="board__grid__item__title-img">' . $news[$i]['title'] . '</h3>
                    <span class="board__grid__item__date board__grid__item__date-img">' . $news[$i]['date'] . '</span></a>';
                    } else {
                        echo '<h3 class="board__grid__item__title">' . $news[$i]['title'] . '</h3>
                    <span class="board__grid__item__date board__grid__item__date">' . $news[$i]['date'] . '</span></a>';
                    }

                }
                ?>
            </div>
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
<?php
mysqli_close($database);
?>