<div class="row">
    <section class="span3 endeavour blabla">
        <header>
            <h1>Latest<br >
                News
            </h1>
        </header>
        <? foreach($news as $article) : ?>
            <? if($article->isElementable()) : ?>
                <article class="endeavour">
                    <img src="<?= $article->getElements()->image->value ? $article->getElements()->image->value : 'http://placehold.it/350x230' ; ?>" />
                    <h1><?= $article->title; ?></h1>
                    <time datetime="<?= @date(array('date' => $article->created_on, 'format' => '%Y-%d-%m')); ?>"><?= @date(array('date' => $article->created_on, 'format' => '%d %B %Y')); ?></time>
                </article>
            <? endif; ?>
        <? endforeach; ?>
        <footer>
            <a href="<?= @route('view=conversations'); ?>"><?= @text('View All Latest News'); ?></a>
        </footer>
    </section>
</div>