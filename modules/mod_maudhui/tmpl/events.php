<div class="row">
    <section class="span3 tangerine blabla">
        <header>
            <h1>Upcomming<br >
                Events
            </h1>
        </header>
        <? foreach($events as $event) : ?>
            <? if($event->isElementable()) : ?>
                <article class="tangerine">
                    <img src="http://placehold.it/350x230" />
                    <h1>This is a nice test for two lines</h1>
                    <p>Type</p>
                    <time>Some time</time>
                </article>
            <? endif; ?>
        <? endforeach; ?>
        <article>
            <img src="http://placehold.it/350x230" />
            <h1>This is a nice test for two lines</h1>
            <p>Type</p>
            <time>Some time</time>
        </article>
        <article>
            <img src="http://placehold.it/350x230" />
            <h1>This is a nice test for two lines</h1>
            <p>Type</p>
            <time>Some time</time>
        </article>
        <footer>
            <a href="<?= @route('view=events'); ?>"><?= @text('View All Upcomming Events'); ?></a>
        </footer>
    </section>
</div>