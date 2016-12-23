<?php if (count($news) > 0): ?>
    <div class="news">
        <?php foreach ($news as $item): ?>
            <div class="news__row">
                <div class="news__image">
                    <?php $image = db()->table('images')->find($item->image_id) ?>
                    <img src="<?= asset('img/uploaded/' . $image->name) ?>">
                </div>
                <div class="news__content">
                    <h2>
                        <a href="#"><?= e($item->title) ?></a>
                    </h2>
                    <div>
                        <span class="date"><?= $item->created_at ?></span>
                    </div>
                    <div>
                        <?= nl2br(e($item->content)) ?>
                    </div>
                    <div>
                        <a href="<?= url('news.show', [$item->id]) ?>"
                           class="btn btn-more">Подробнее &rarr;</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="center">Пока нет новостей</div>
<?php endif; ?>