<div class="article">
    <h2 class="title">Добавить пользователя</h2>
    <form action="<?= url('/admin/users') ?>" method="post" class="form">
        <div class="field">
            <label for="username" class="label">Логин:</label>
            <input id="username" name="username" type="text" class="input" required>
        </div>
        <div class="field">
            <label for="password" class="label">Пароль:</label>
            <input id="password" name="password" type="text" class="input" required>
        </div>
        <div class="field">
            <label for="email" class="label">E-mail:</label>
            <input id="email" name="email" type="email" class="input" required>
        </div>
        <div class="control">
            <button class="btn">Добавить</button>
        </div>
    </form>
</div>

<div class="article">
    <h2 class="title">Список пользователей</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Логин</th>
            <th>E-mail</th>
            <th>Админ</th>
            <th>Время создания</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->admin == 1 ? 'Да' : 'Нет' ?></td>
                <td><?= $user->created_at ?></td>
                <td>
                    <a href="<?= url('admin.users.edit', [$user->id]) ?>">Изменить</a><br>
                    <a href="<?= url('admin.users.destroy', [$user->id]) ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>