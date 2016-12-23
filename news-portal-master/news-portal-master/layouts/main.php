<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo $__title ?? config('app.name') ?></title>

    <link rel="stylesheet" type="text/css" href="/css/main.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
</head>
<body>

<?php $menu = menu('main') ?>

<div id="login-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            Авторизация
        </div>
        <div class="modal-body">
            <form id="login-form" action="<?= url('/login') ?>" method="post" class="form">
                <div class="field">
                    <label for="username" class="label">Логин:</label>
                    <input id="username" type="text" name="username" class="input">
                </div>
                <div class="field">
                    <label for="password" class="label">Пароль:</label>
                    <input id="password" type="password" name="password" class="input">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button data-toggle="modal" type="button" class="btn">Закрыть</button>
            <button id="login-button" type="button" class="btn">Войти</button>
        </div>
    </div>
</div>

<div class="page-wrapper">
    <header class="header">
        <nav class="nav">
            <ul class="nav__menu">
                <?php foreach ($menu as $item): ?>
                    <li><a href="<?= $item['url'] ?>"><?= $item['title'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <nav class="nav pull-right">
            <ul class="nav__menu">
                <?php if (auth()->guest()): ?>
                    <li><a id="login" href="<?= url('/login') ?>">Авторизация</a></li>
                    <li><a href="<?= url('/register') ?>">Регистрация</a></li>
                <?php else: ?>
                    <li><a href="<?= url('/logout') ?>">Выход [<?= auth()->user()->username ?>]</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="container">
        <main class="content">
            <?php if (array_key_exists('message', $_SESSION)): ?>
                <div class="alert"><?php echo $_SESSION['message'] ?></div>
                <?php unset($_SESSION['message']) ?>
            <?php endif; ?>
            <?php if (array_key_exists('errors', $_SESSION)): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $key => $value): ?>
                            <li><?php echo implode('</li><li>', $value) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']) ?>
            <?php endif; ?>
            <?php echo $__content ?? '' ?>
        </main>
    </div>
</div>

<script>
    $('#login').on('click', function (e) {
        $('#login-modal').toggleClass('active');
        e.preventDefault();
    });
    $('[data-toggle=modal]').on('click', function (e) {
        $(this).closest('.modal').toggleClass('active');
        e.preventDefault();
    });
    $('#login-button').on('click', function (e) {
        $('#login-form').submit();
        e.preventDefault();
    });
</script>

<?php echo $this->stack('scripts') ?>

</body>
</html>