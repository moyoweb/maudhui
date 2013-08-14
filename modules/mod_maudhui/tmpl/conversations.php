<div class="row">
    <section class="span3 gigas">
        <header>
            <h1>
                Join Community<br >
                Converstations
            </h1>
        </header>
        <? foreach($conversations as $conversation) : ?>
        <? if($conversation->isElementable()) : ?>
        <article class="gigas">
            <div class="body arrow-bottom">
                <p>
                    <?= strip_tags($conversation->getElements()->content->value); ?>
                </p>
                <a href="<?= @route('option=com_maudhui&view=conversation&id='.$conversation->id); ?>" class="btn"><span>Join Conversation</span></a>
            </div>
            <footer>
                <div class="row">
                    <div class="span1">
                        <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
                    </div>
                    <div class="span2 contributed-by">
                        <h1><?= $conversation->getUser()->name; ?></h1>
                        <time><?= @helper('date.humanize', array('date' => $conversation->created_on)); ?></time>
                    </div>
                </div>
            </footer>
        </article>
        <? endif; ?>
        <? endforeach; ?>
        <footer>
            <a href="<?= @route('view=conversations'); ?>"><?= @text('View All Community Conversations'); ?></a>
        </footer>
    </section>
</div>