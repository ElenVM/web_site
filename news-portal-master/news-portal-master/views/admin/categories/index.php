<div class="article">
    <h2 class="title">Добавить категорию</h2>
    <form action="<?= url('/admin/categories') ?>" method="post" class="form">
        <div class="field">
            <label for="name" class="label">Название:</label>
            <input id="name" name="name" type="text" class="input">
        </div>
        <div class="control">
            <button class="btn">Добавить</button>
        </div>
    </form>
</div>

<div class="article">
    <h2 class="title">Список категорий</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $item): ?>
            <tr>
                <td><?= $item->id ?></td>
                <td><?= $item->name ?></td>
                <td>
                    <a href="<?= url('admin.categories.destroy', [$item->id]) ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>