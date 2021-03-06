<?php
if (!isset($_COOKIE['user'])) {
    header("Location: ./");
}
include('functions.php');
$news = mysqli_fetch_all(mysqli_query($database, 'SELECT * FROM news WHERE status = "on check" ORDER BY id'), MYSQLI_BOTH);
$category = mysqli_fetch_all(mysqli_query($database, 'SELECT categories.name AS name FROM join_table INNER JOIN categories ON (join_table.category_id = categories.id) INNER JOIN news ON (news.id = news_id) WHERE status = "on check" ORDER BY news.id'), MYSQLI_BOTH);
$old_email = $_COOKIE['user'];
$user = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE email = '$old_email'"), MYSQLI_BOTH);
if (($_COOKIE['user'] != $user[0]['email']) || ($_COOKIE['name'] != $user[0]['name']) || ($_COOKIE['id'] != $user[0]['id']) || ($_COOKIE['type_id'] != $user[0]['type_id'])) {
    unset($_COOKIE['user']);
    unset($_COOKIE['name']);
    unset($_COOKIE['id']);
    unset($_COOKIE['type_id']);
    setcookie('user', null, -1, '/');
    setcookie('name', null, -1, '/');
    setcookie('id', null, -1, '/');
    setcookie('type_id', null, -1, '/');
    header("Location: ./");
}
$temp_email = false;
$temp_name = false;
$temp_password = false;
$temp = '';
?>
<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["old-password"]) && !empty($_POST["new-password"])) {
        $old_password = filter_var(trim($_POST['old-password']), FILTER_SANITIZE_STRING);
        $hesh = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE email = '$old_email'"), MYSQLI_BOTH);
        if (password_verify(super_hash($old_password), $hesh[0]['password'])) {
            if ($_POST["new-password"] == $_POST["new-password2"]) {
                if (!empty($_POST["new-name"])) {
                    $name = filter_var(trim($_POST['new-name']), FILTER_SANITIZE_STRING);
                    mysqli_query($database, "UPDATE users SET users.name = '$name' WHERE email = '$old_email'");
                    setcookie('name', $name, time() + 3600, "/");
                    $temp_name = true;
                }
            }
        }
    } else {
        if (!empty($_POST["new-name"])) {
            $name = filter_var(trim($_POST['new-name']), FILTER_SANITIZE_STRING);
            mysqli_query($database, "UPDATE users SET users.name = '$name' WHERE email = '$old_email'");
            setcookie('name', $name, time() + 3600, "/");
            $temp_name = true;
        }
    }
}
?>
<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["old-password"]) && !empty($_POST["new-password"])) {
        $old_password = filter_var(trim($_POST['old-password']), FILTER_SANITIZE_STRING);
        $hesh = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE email = '$old_email'"), MYSQLI_BOTH);
        if (password_verify(super_hash($old_password), $hesh[0]['password'])) {
            if ($_POST["new-password"] == $_POST["new-password2"]) {
                $new_password = filter_var(trim($_POST['new-password']), FILTER_SANITIZE_STRING);
                $new_password = password_hash(super_hash($new_password), PASSWORD_DEFAULT);
                mysqli_query($database, "UPDATE users SET password = '$new_password' WHERE email = '$old_email'");
                $old_password = filter_var(trim($_POST['new-password']), FILTER_SANITIZE_STRING);
                $temp_password = true;
            } else {
                $temp = 'different';
            }
        } else {
            $temp = 'incorrect';
        }

    }
}
?>
<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["old-password"]) && !empty($_POST["new-password"])) {
        $hesh = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE email = '$old_email'"), MYSQLI_BOTH);
        if (password_verify(super_hash($old_password), $hesh[0]['password'])) {
            if ($_POST["new-password"] == $_POST["new-password2"]) {
                if (!empty($_POST["new-email"])) {
                    $email = filter_var(trim($_POST['new-email']), FILTER_SANITIZE_EMAIL);
                    mysqli_query($database, "UPDATE users SET email = '$email' WHERE email = '$old_email'");
                    setcookie('user', $email, time() + 3600, "/");
                    $temp_email = true;
                }
            }
        }
    } else {
        if (!empty($_POST["new-email"])) {
            $email = filter_var(trim($_POST['new-email']), FILTER_SANITIZE_EMAIL);
            mysqli_query($database, "UPDATE users SET email = '$email' WHERE email = '$old_email'");
            setcookie('user', $email, time() + 3600, "/");
            $temp_email = true;
        }
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
    header("Location: ./");
}
?>
<?php
if (isset($_POST["delete"])) {
    $email = $_COOKIE['user'];
    $array = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE email = '$email'"), MYSQLI_BOTH);
    $author = $array[0]['id'];
    mysqli_query($database, "DELETE FROM news WHERE author_id = $author");
    mysqli_query($database, "DELETE FROM users WHERE email = '$email'");
    setcookie('user', $array[0]['email'], time() - 3600, "/");
    setcookie('name', $array[0]['name'], time() - 3600, "/");
    setcookie('id', $array[0]['id'], time() - 3600, "/");
    setcookie('type_id', $array[0]['type_id'], time() - 3600, "/");
    header("Location: ./");
}
?>
<?php

if (isset($_POST["add-new-submit"])) {
    $category = filter_var(trim($_POST['add-new-category']), FILTER_SANITIZE_STRING);
    $title = filter_var(trim($_POST['add-new-title']), FILTER_SANITIZE_STRING);
    $text = filter_var(trim($_POST['add-new-text']), FILTER_SANITIZE_STRING);
    $id = $_COOKIE['id'];
    mysqli_query($database, "INSERT INTO news (title, text, date, author_id, status) VALUES ('$title', '$text', CURRENT_DATE(), $id, 'on check')");
    $news_id = mysqli_fetch_all(mysqli_query($database, "SELECT LAST_INSERT_ID() AS id"), MYSQLI_BOTH);
    $news_id = $news_id[0]['id'];
    $category_id = mysqli_fetch_all(mysqli_query($database, "SELECT id FROM categories WHERE categories.name = '$category'"), MYSQLI_BOTH);
    $category_id = $category_id[0]['id'];
    mysqli_query($database, "INSERT INTO join_table (news_id, category_id) VALUES ($news_id, $category_id)");
    if (($_FILES['image']['type'] == 'image/webp') && ($_FILES['image']['size'] < 5 * 1024 * 1024)) {
        $_FILES['image']['name'] = 'img' . $news_id . '.webp';
        $file = "img/news/" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $file);
        imagejpeg(resize_image($file, 300, 300), "img/news-small/" . $_FILES['image']['name']);
    }
    header("Location: ./cabinet.php");
}
?>
<?php
if (isset($_POST["edit-new-delete"])) {
    $hidden = $_POST['edit-new-hidden'];
    mysqli_query($database, "DELETE FROM join_table WHERE news_id = $hidden");
    mysqli_query($database, "DELETE FROM news WHERE news.id = $hidden");
    $useless = unlink('img/news/img' . $hidden . '.webp');
    $useless = unlink('img/news-small/img' . $hidden . '.webp');
    header("Location: ./cabinet.php");
}
?>
<?php
if (isset($_POST["edit-new-submit"])) {
    $category = filter_var(trim($_POST['edit-new-category']), FILTER_SANITIZE_STRING);
    $title = filter_var(trim($_POST['edit-new-title']), FILTER_SANITIZE_STRING);
    $text = filter_var(trim($_POST['edit-new-text']), FILTER_SANITIZE_STRING);
    $hidden = $_POST['edit-new-hidden'];
    mysqli_query($database, "UPDATE news SET title = '$title', text = '$text', date = CURRENT_DATE(), status = 'accepted' WHERE id = '$hidden'");
    $category_id = mysqli_fetch_all(mysqli_query($database, "SELECT id FROM categories WHERE categories.name = '$category'"), MYSQLI_BOTH);
    $category_id = $category_id[0]['id'];
    mysqli_query($database, "UPDATE join_table SET category_id = $category_id WHERE news_id = $hidden");
    if ((!empty($_FILES)) && (isset($_FILES))) {
        if (($_FILES['image']['type'] == 'image/webp') && ($_FILES['image']['size'] < 5 * 1024 * 1024)) {
            $_FILES['image']['name'] = 'img' . $hidden . '.webp';
            $file = "img/news/" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            imagejpeg(resize_image($file, 300, 300), "img/news-small/" . $_FILES['image']['name']);
        }
    }
    header("Location: ./cabinet.php");
}
?>
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
    <link rel="stylesheet" href="css/drawer.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
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
                        <a href="./politics.php" class="menu__list__item__link" role="menuitem">Политика</a>
                    </li>
                    <li class="menu__list__item">
                        <a href="./economy.php" class="menu__list__item__link" role="menuitem">Экономика</a>
                    </li>
                    <li class="menu__list__item">
                        <a href="./sport.php" class="menu__list__item__link" role="menuitem">Спорт</a>
                    </li>
                </ul>
            </nav>
            <div class="cabinet-mobile">
                <form action="./" method="post">
                    <input type="submit" name="submit-out" class="cabinet__btn cabinet__out" value="Выйти">
                </form>
                <a href="#" class="cabinet__link">
                    <img src="img/icons/user.svg" alt="Личный кабинет">
                </a>
            </div>
        </div>
        <div class="cabinet">
            <a href="#" class="cabinet__link">
                <img src="img/icons/user.svg" alt="Личный кабинет">
            </a>
            <form action="./" method="post">
                <input type="submit" name="submit-out" class="cabinet__btn cabinet__out" value="Выйти">
            </form>
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
            <?php if (($_COOKIE['type_id'] == 1) || ($_COOKIE['type_id'] == 3)): ?>
                <li>Проверить новости</li>
            <?php endif; ?>
            <?php if ($_COOKIE['type_id'] == 1): ?>
                <li>Статистика</li>
            <?php endif; ?>
        </ul>
        <form action="" method="post" class="delete-form-drawer">
            <input type="submit" name="delete" value="Удалить аккаунт"
                   class="delete-form__btn">
        </form>
    </div>
    <aside class="cabinet-main__sidebar">
        <ul class="tabs__caption">
            <li class="active">Учетная запись</li>
            <li>Предложить новость</li>
            <?php if (($_COOKIE['type_id'] == 1) || ($_COOKIE['type_id'] == 3)): ?>
                <li>Проверить новости</li>
            <?php endif; ?>
            <?php if ($_COOKIE['type_id'] == 1): ?>
                <li>Статистика</li>
            <?php endif; ?>
        </ul>
        <form action="" method="post" class="delete-form">
            <input type="submit" name="delete" value="Удалить аккаунт"
                   class="delete-form__btn">
        </form>
    </aside>
    <div class="cabinet-main__content">
        <h1 class="tabs__content__main-title">Добро пожаловать, <?php echo $_COOKIE['name'] ?></h1>
        <div class="tabs__content active">
            <form action="" method="post" class="cabinet-main__content__form">
                <div class="cabinet-main__content__form__left">
                    <h2>Сменить имя:</h2>
                    <label for="new-name">Ваше новое имя:</label>
                    <input type="text" name="new-name" minlength="4" maxlength="50" id="new-name"
                           class="form-input"
                           placeholder="Ваше новое имя">
                    <h2>Сменить email:</h2>
                    <label for="new-email">Ваш новый E-mail:</label>
                    <input type="email" name="new-email" id="new-email" class="form-input"
                           placeholder="Ваш новый e-mail">
                    <input type="submit" name="submit" value="Сохранить"
                           class="cabinet-main__content__form__save">
                </div>
                <div class="cabinet-main__content__form__right">
                    <h2>Сменить пароль:</h2>
                    <label for="old-password">Введите ваш старый пароль:</label>
                    <input type="password" name="old-password" id="old-password" class="form-input"
                           placeholder="Ваш старый пароль">
                    <label for="new-password">Придумайте новый пароль:</label>
                    <input type="password" minlength="8" name="new-password" id="new-password"
                           class="form-input"
                           placeholder="Ваш новый пароль">
                    <label for="new-password2">Повторите новый пароль:</label>
                    <input type="password" minlength="8" name="new-password2" id="new-password2"
                           class="form-input"
                           placeholder="Ваш новый пароль">
                </div>
            </form>
        </div>
        <div class="tabs__content">
            <h2>Предложить новость:</h2>
            <form action="" method="post" id="add-new" class="add-new" enctype="multipart/form-data">
                <label for="add-new-category">Выберите тему<span>*</span>:</label>
                <select required name="add-new-category" id="add-new-category"
                        class="form-input">
                    <option value="Политика">Политика</option>
                    <option value="Экономика">Экономика</option>
                    <option value="Спорт">Спорт</option>
                </select>
                <label for="add-new-title">Заголовок (Максимум 60 символов)<span>*</span>:</label>
                <input required type="text" maxlength="60" name="add-new-title" id="add-new-title"
                       class="form-input"
                       placeholder="Заголовок новости">
                <label for="add-new-text">Текст<span>*</span>:</label>
                <textarea required minlength="500" placeholder="Текст новости" name="add-new-text" id="add-new-text"
                          class="form-input"></textarea>
                <label for="add-new-file">Загрузите картинку(только WebP)<span>*</span>:</label>
                <input required type="file" name="image" id="add-new-file" accept="image/webp">
                <input type="submit" name="add-new-submit" value="Отправить" class="add-new-send">
            </form>
        </div>
        <?php if (($_COOKIE['type_id'] == 1) || ($_COOKIE['type_id'] == 3)): ?>
            <div class="tabs__content">
                <ul class="edit">
                    <?php
                    if (count($news) > 0) {
                        for ($i = 0; $i < count($news); $i++) {
                            $selected1 = '';
                            $selected2 = '';
                            $selected3 = '';
                            switch ($category[$i]['name']) {
                                case "Политика":
                                    $selected1 = 'selected';
                                    break;
                                case "Экономика":
                                    $selected2 = 'selected';
                                    break;
                                case "Спорт":
                                    $selected3 = 'selected';
                                    break;
                            }
                            echo '<li class="edit__item">
                                        <form action="" method="post" class="edit-new" enctype="multipart/form-data">
                                            <select required name="edit-new-category"
                                                    class="form-input">
                                                <option value="Политика" ' . $selected1 . '>Политика</option>
                                                <option value="Экономика" ' . $selected2 . '>Экономика</option>
                                                <option value="Спорт" ' . $selected3 . '>Спорт</option>
                                            </select>
                                            <input required type="text" maxlength="60" name="edit-new-title"
                                                   class="form-input"
                                                   value="' . $news[$i]["title"] . '"
                                                   placeholder="Заголовок новости">
                                            <textarea required minlength="500" placeholder="Текст новости" name="edit-new-text"
                                                      class="form-input">' . $news[$i]["text"] . '</textarea>
                                            <a class="fancybox" rel="group" href="./img/news/img' . $news[$i]["id"] . '.webp" data-fancybox>
                                                <img src="./img/news/img' . $news[$i]["id"] . '.webp" alt="Картинка новости" class="edit-new-img">
                                            </a>
                                            <input type="file" class="form-input" name="image" accept="image/webp">
                                            <input type="hidden" name="edit-new-hidden" value="' . $news[$i]["id"] . '">
                                            <div class="edit-new-btns"> 
                                            <input type="submit" name="edit-new-submit" value="Отправить" class="edit-new-send">
                                            <input type="submit" name="edit-new-delete" value="Удалить" class="edit-new-delete">
                                            </div>
                                        </form>
                                    </li>';
                        }
                    } else {
                        echo '<li class="no-news">Новостей пока нет</li>';
                    }
                    ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if ($_COOKIE['type_id'] == 1): ?>
            <div class="tabs__content">
                <div class="stats">
                    <canvas id="stats__item__dates">

                    </canvas>
                    <canvas id="stats__item__users">

                    </canvas>
                    <canvas id="stats__item__users-type">

                    </canvas>
                    <canvas id="stats__item__news-categories">

                    </canvas>
                </div>
            </div>
        <?php endif; ?>
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
<script src="js/sweetalert2.min.js"></script>
<script src="js/chart.min.js"></script>
<?php
$accepted_news = mysqli_fetch_all(mysqli_query($database, 'SELECT count(date) AS dates, date FROM news WHERE status = "accepted" GROUP BY date ORDER BY date DESC'), MYSQLI_BOTH);
$users = mysqli_fetch_all(mysqli_query($database, 'SELECT count(date) AS dates, date FROM users GROUP BY date ORDER BY date DESC'), MYSQLI_BOTH);
$user_types = mysqli_fetch_all(mysqli_query($database, 'SELECT count(type_id) AS type FROM users GROUP BY type_id ORDER BY type_id DESC'), MYSQLI_BOTH);
$news_categories = mysqli_fetch_all(mysqli_query($database, 'SELECT count(category_id) AS category_id_count FROM join_table GROUP BY category_id ORDER BY category_id DESC'), MYSQLI_BOTH);

$last_days = [
    0 => date("Y-m-d"),
    1 => date("Y-m-d", strtotime("-1 day")),
    2 => date("Y-m-d", strtotime("-2 day")),
    3 => date("Y-m-d", strtotime("-3 day")),
    4 => date("Y-m-d", strtotime("-4 day")),
    5 => date("Y-m-d", strtotime("-5 day")),
    6 => date("Y-m-d", strtotime("-6 day")),
    7 => date("Y-m-d", strtotime("-7 day")),
    8 => date("Y-m-d", strtotime("-8 day")),
    9 => date("Y-m-d", strtotime("-9 day")),
    10 => date("Y-m-d", strtotime("-10 day")),
    11 => date("Y-m-d", strtotime("-11 day")),
    12 => date("Y-m-d", strtotime("-12 day")),
    13 => date("Y-m-d", strtotime("-13 day")),
    14 => date("Y-m-d", strtotime("-14 day")),
    15 => date("Y-m-d", strtotime("-15 day")),
    16 => date("Y-m-d", strtotime("-16 day")),
    17 => date("Y-m-d", strtotime("-17 day")),
    18 => date("Y-m-d", strtotime("-18 day")),
    19 => date("Y-m-d", strtotime("-19 day")),
];
$dates = array();
$j = 0;
for ($i = 0; $i < 20; $i++) {
    if (strval($accepted_news[$j]['date']) == strval($last_days[$i])) {
        $dates[] = $accepted_news[$j]['dates'];
        $j++;
    } else {
        $dates[] = 0;
    }
}
$users_arr = array();
$j = 0;
for ($i = 0; $i < 20; $i++) {
    if (strval($users[$j]['date']) == strval($last_days[$i])) {
        $users_arr[] = $users[$j]['dates'];
        $j++;
    } else {
        $users_arr[] = 0;
    }
}
?>
<script>
    $(document).ready(function () {
        <?php if ($_COOKIE['type_id'] == 1): ?>
        var date = [];
        var dateTimeFormat = [];
        for (var i = 0; i < 20; i++) {
            date[i] = new Date();
            date[i].setDate(date[i].getDate() - i);
            dateTimeFormat[i] = new Intl.DateTimeFormat('ru', {
                year: '2-digit',
                month: '2-digit',
                day: '2-digit'
            }).format(date[i]);
        }
        dateTimeFormat.reverse();
        var count_dates = [
            <?php
            for ($i = 0; $i < count($dates); $i++) {
                echo $dates[$i] . ', ';
            }
            ?>
        ];
        var count_users = [
            <?php
            for ($i = 0; $i < count($users_arr); $i++) {
                echo $users_arr[$i] . ', ';
            }
            ?>
        ];
        var count_user_types = [
            <?php
            for ($i = 0; $i < count($user_types); $i++) {
                echo $user_types[$i]['type'] . ', ';
            }
            ?>
        ];
        var news_categories_count = [
            <?php
            for ($i = 0; $i < count($news_categories); $i++) {
                echo $news_categories[$i]['category_id_count'] . ', ';
            }
            ?>
        ];
        var aspectRatio = 2;
        if (window.screen.width < 800) {
            aspectRatio = 1;
        }
        var ctx1 = document.getElementById('stats__item__dates').getContext('2d');
        var chart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: dateTimeFormat,
                datasets: [{
                    label: 'Количество',
                    backgroundColor: 'lightblue',
                    borderColor: 'royalblue',
                    data: count_dates.reverse(),
                }]
            },
            options: {
                layout: {
                    padding: 10,
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Количество новостей за последние дни'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Количество новостей'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Даты'
                        }
                    }]
                },
                aspectRatio: aspectRatio
            }
        });
        var ctx2 = document.getElementById('stats__item__users').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: dateTimeFormat,
                datasets: [{
                    label: 'Количество',
                    backgroundColor: 'lightsalmon',
                    borderColor: 'salmon',
                    data: count_users.reverse(),
                }]
            },
            options: {
                layout: {
                    padding: 10,
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Количество новых пользователей за последние дни'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Количество пользователей'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Даты'
                        }
                    }]
                },
                aspectRatio: aspectRatio
            }
        });
        var bar1 = document.getElementById('stats__item__users-type').getContext('2d');
        var barConfig = new Chart(bar1, {
            type: 'bar',
            data: {
                labels: ['Редакторы', 'Пользователи', 'Админы'],
                datasets: [{
                    label: 'Количество пользователей',
                    data: count_user_types,
                    backgroundColor: [
                        'lightblue',
                        'lightpink',
                        'lightgreen',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                layout: {
                    padding: 10,
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Количество пользователей по типам'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Количество пользователей'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Тип'
                        }
                    }]
                },
                aspectRatio: aspectRatio
            }
        });
        var bar2 = document.getElementById('stats__item__news-categories').getContext('2d');
        var barConfig = new Chart(bar2, {
            type: 'bar',
            data: {
                labels: ['Спорт', 'Экономика', 'Политика'],
                datasets: [{
                    label: 'Количество новостей',
                    data: news_categories_count,
                    backgroundColor: [
                        'lightsteelblue',
                        'lightcyan',
                        'lightgoldenrodyellow',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                layout: {
                    padding: 10,
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Новостей в каждой категории'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Количество новостей'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Категория'
                        }
                    }]
                },
                aspectRatio: aspectRatio
            }
        });
        <?php endif; ?>
        <?php
        if ($temp == 'incorrect') {
            echo '
               Swal.fire({
                        title: \'Ошибка!\',
                        text: \'Неверный пароль\',
                        icon: \'error\',
                        confirmButtonText: \'OK\'
                    })
                ';
        } elseif ($temp == 'different') {
            echo '
               Swal.fire({
                        title: \'Ошибка!\',
                        text: \'Пароли не совпадают\',
                        icon: \'error\',
                        confirmButtonText: \'OK\'
                    })
                ';
        } elseif ($temp_name || $temp_email || $temp_password) {
            echo '
                Swal.fire({
                        title: \'Успешно!\',
                        text: \'Ваши данные успешно изменены!\',
                        icon: \'success\',
                        confirmButtonText: \'OK\'
                    })
                ';
            if ($temp_name) {
                echo '$(".tabs__content__main-title").text("Добро пожаловать, ' . $name . '")';
            }
        }

        ?>
    });
</script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/iscroll.min.js"></script>
<script src="js/drawer.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<?php
mysqli_close($database);
?>
