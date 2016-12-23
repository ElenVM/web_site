<div class="article">
    <h2 class="title">Добавить новость</h2>
    <form action="<?= url('/admin/news') ?>" method="post" enctype="multipart/form-data" class="form">
        <div class="field">
            <label for="title" class="label">Заголовок:</label>
            <input id="title" name="title" type="text" class="input">
        </div>
        <div class="field">
            <label for="category" class="label">Категория:</label>
            <select id="category" name="category" class="input">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= e($category->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field">
            <label for="image" class="label">Изображение:</label>
            <input id="image" name="image" type="file" accept="image/*" class="input">
        </div>
        <div class="field">
            <label for="content" class="label">Содержимое:</label>
            <textarea id="content" name="content" class="input text-plain"></textarea>
        </div>
        <div class="control">
            <button class="btn">Добавить</button>
        </div>
    </form>
</div>

<div class="article">
    <?php echo $this->view('_news') ?>
</div>