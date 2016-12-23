<ul>
    <?php foreach ($categories as $category): ?>
        <li>
            <a href="<?= url('category', [$category->id]) ?>"><?= $category->name ?></a>
        </li>
    <?php endforeach; ?>
</ul>