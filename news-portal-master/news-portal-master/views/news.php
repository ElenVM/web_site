<div class="article">
    <h1 class="title"><?= e($news->title) ?></h1>
    <p style="text-align: center">
        <img src="<?= asset('img/uploaded/' . $image->name) ?>" style="width: 60%; height: auto">
    </p>
    <p>
        <?= nl2br(e($news->content)) ?>
    </p>
</div>