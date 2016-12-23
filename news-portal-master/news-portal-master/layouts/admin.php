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

<?php $menu = menu('admin') ?>

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
                <li><a href="<?= url('/') ?>">Перейти к сайту</a></li>
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

<?php echo $this->stack('scripts') ?>

</body>
</html>