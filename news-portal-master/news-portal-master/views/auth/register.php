<div class="post">
    <h2 class="title">Регистрация нового пользователя</h2>
    <form action="<?= url('/register') ?>" method="post" class="form">
        <div class="field">
            <label for="username" class="label">Логин:</label>
            <input id="username" name="username" type="text" class="input">
        </div>
        <div class="field">
            <label for="password" class="label">Пароль:</label>
            <input id="password" name="password" type="password" class="input">
        </div>
        <div class="field">
            <label for="password_c" class="label">Повторите пароль:</label>
            <input id="password_c" name="password_c" type="password" class="input">
        </div>
        <div class="field">
            <label for="email" class="label">E-mail:</label>
            <input id="email" name="email" type="text" class="input">
        </div>
        <div class="control">
            <button class="btn">Продолжить</button>
        </div>
    </form>
</div>