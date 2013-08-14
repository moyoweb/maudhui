<div class="popular-topics">
    <header>
        <h1> Discover Other Popular Topics</h1>
    </header>
    <div class="body">
        <? foreach($topics as $topic) : ?>
            <a href="<?= @route('view=maudhui&view=topic&id='.$topic->id); ?>" class="btn"><span><?= $topic->title; ?></span></a>
        <? endforeach; ?>
    </div>
</div>