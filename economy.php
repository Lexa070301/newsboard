<?php
include('functions.php');
$news = mysqli_fetch_all(mysqli_query($database, 'SELECT news.id AS id, title, date FROM news INNER JOIN join_table ON (news.id = news_id) INNER JOIN categories ON (category_id = categories.id) WHERE status = "accepted" AND name = "Экономика" ORDER BY news.id DESC'), MYSQLI_BOTH);
$description = mysqli_fetch_all(mysqli_query($database, 'SELECT description FROM categories WHERE name = "Экономика"'), MYSQLI_BOTH);
$keywords = mysqli_fetch_all(mysqli_query($database, 'SELECT keyword FROM categories INNER JOIN keywords ON (categories.id = keywords.category_id) WHERE name = "Экономика"'), MYSQLI_BOTH);

if (isset($_POST["submit"])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $password = password_hash(super_hash($password), PASSWORD_DEFAULT);
    mysqli_query($database, "INSERT INTO users (name, email, password, type_id, date) VALUES ('$name', '$email', '$password', 2, CURRENT_DATE())");
    $temp = 'registration';
}
?>
<?php
if (isset($_POST["submit-enter"])) {
    $email = filter_var(trim($_POST['email-enter']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(trim($_POST['password-enter']), FILTER_SANITIZE_STRING);
    $hesh = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE email = '$email'"), MYSQLI_BOTH);
    if (count($hesh) == 0) {
        $temp = 'not found';
    } else
        if (password_verify(super_hash($password), $hesh[0]['password'])) {
            setcookie('user', $hesh[0]['email'], time() + 3600, "/");
            setcookie('name', $hesh[0]['name'], time() + 3600, "/");
            setcookie('id', $hesh[0]['id'], time() + 3600, "/");
            setcookie('type_id', $hesh[0]['type_id'], time() + 3600, "/");
            header("Location: ./economy.php");
        } else {
            $temp = 'incorrect';
        }
}
?>
<?php
if (isset($_POST["submit-out"])) {
    $email = $_COOKIE['user'];
    $array = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE email = '$email'"), MYSQLI_BOTH);
    setcookie('user', $array[0]['email'], time() - 3600, "/");
    setcookie('name', $array[0]['name'], time() - 3600, "/");
    setcookie('id', $array[0]['id'], time() - 3600, "/");
    setcookie('type_id', $array[0]['type_id'], time() - 3600, "/");
    header("Location: ./economy.php");
}
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
        <title>News Board - Политика</title>
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/swiper.min.css">
        <link rel="stylesheet" href="css/remodal.css">
        <link rel="stylesheet" href="css/remodal-default-theme.css">
        <link rel="stylesheet" href="css/sweetalert2.min.css">
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
                            <a href="./politics.php" class="menu__list__item__link" role="menuitem">Политика</a>
                        </li>
                        <li class="menu__list__item menu__list__item-active">
                            <a href="./economy.php" class="menu__list__item__link" role="menuitem">Экономика</a>
                        </li>
                        <li class="menu__list__item">
                            <a href="./sport.php" class="menu__list__item__link" role="menuitem">Спорт</a>
                        </li>
                    </ul>
                </nav>
                <div class="cabinet-mobile">
                    <?php
                    if ($_COOKIE['user'] == '') {
                        echo '<button class="cabinet__btn cabinet__registration">Зарегистрироваться</button>
                              <button class="cabinet__btn cabinet__enter">Войти</button>';
                    } else {
                        echo '<form action="./" method="post">
                                <input type="submit" name="submit-out" class="cabinet__btn cabinet__out" value="Выйти">
                              </form>
                              <a href="./cabinet.php" class="cabinet__link">
                                <img src="img/icons/user.svg" alt="Личный кабинет">
                              </a>';
                    }
                    ?>
                </div>
            </div>
            <div class="cabinet">
                <?php
                if ($_COOKIE['user'] == '') {
                    echo '<button class="cabinet__btn cabinet__registration">Зарегистрироваться</button>
                              <button class="cabinet__btn cabinet__enter">Войти</button>';
                } else {
                    echo '<a href="./cabinet.php" class="cabinet__link">
                                <img src="img/icons/user.svg" alt="Личный кабинет">
                              </a>
                              <form action="./" method="post">
                                <input type="submit" name="submit-out" class="cabinet__btn cabinet__out" value="Выйти">
                              </form>';
                }
                ?>
                <div class="cabinet__registration-modal" data-remodal-id="cabinet__registration__modal">
                    <div class="cabinet__modal__container">
                        <h2 class="cabinet__modal__title">Регистрация</h2>
                        <form action="./" method="post" class="cabinet__modal__from cabinet__registration__form">
                            <input required type="text" name="name" minlength="4" maxlength="50" class="name form-input"
                                   placeholder="Ваше имя">
                            <input required type="email" name="email" class="email form-input" placeholder="Ваш E-mail">
                            <input required type="password" minlength="8" name="password" class="password form-input"
                                   placeholder="Введите пароль">
                            <input required type="password" minlength="8" name="password2" class="password form-input"
                                   placeholder="Повторите пароль">
                            <input disabled class="remodal-confirm" type="submit" name="submit"
                                   value="Зарегистрироваться">
                        </form>
                    </div>
                    <a class="remodal-cancel" href="#">х</a>
                </div>
                <div class="cabinet__enter-modal" data-remodal-id="cabinet__enter__modal">
                    <div class="cabinet__modal__container">
                        <h2 class="cabinet__modal__title">Вход</h2>
                        <form action="./" method="post" class="cabinet__modal__from cabinet__enter__form">
                            <input required type="email" name="email-enter" class="email form-input"
                                   placeholder="Ваш E-mail">
                            <input required type="password" name="password-enter" class="password form-input"
                                   placeholder="Введите пароль">
                            <input disabled class="remodal-confirm" type="submit" name="submit-enter" value="Войти">
                        </form>
                    </div>
                    <a class="remodal-cancel" href="#">х</a>
                </div>
            </div>
            <div class="navBurger" role="navigation" id="navToggle"></div>
        </div>
    </header>
    <main>
        <section class="board">
            <div class="container">
                <div class="board__grid">
                    <?php
                    for ($i = 0; $i < count($news); $i++) {
                        echo '<a href="./post.php?id=' . $news[$i]['id'] . '" class="board__grid__item">';
                        if (($i % 2 == 0) || ($i % 3 == 0)) {
                            echo '<img src="#" data-src="img/news-small/img' . $news[$i]['id'] . '.webp" alt="Картинка новости" class="board__grid__item__img">';
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
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/jquery.lazy.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script>
        $(document).ready(function () {
            <?php
            if ($temp == 'not found') {
                echo '
                Swal.fire({
                        title: \'Ошибка!\',
                        text: \'Пользователь не найден\',
                        icon: \'error\',
                        confirmButtonText: \'OK\'
                    })
                ';
            } elseif ($temp == 'incorrect') {
                echo '
               Swal.fire({
                        title: \'Ошибка!\',
                        text: \'Неверный пароль\',
                        icon: \'error\',
                        confirmButtonText: \'OK\'
                    })
                ';
            } elseif ($temp == 'registration') {
                echo '
               Swal.fire({
                        title: \'Поздравляем!\',
                        text: \'Теперь вы можете войти в свой аккаунт\',
                        icon: \'success\',
                        confirmButtonText: \'OK\'
                    })
                ';
            }
            ?>
        });
    </script>
    <script src="js/remodal.min.js"></script>
    <script src="js/drawer.min.js"></script>
    <script src="js/main.js"></script>
    </body>
    </html>
<?php
mysqli_close($database);
?>