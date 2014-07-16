<div class="row">
    <section class="span3 picton-blue">
        <header>
            <h1>Questions & <br >
                Answers</h1>
        </header>
        <? foreach($questions as $question) : ?>
        <? if($question->isElementable()) : ?>
        <article class="picton-blue">
            <div class="body arrow-bottom">
                <p>
                    <?= strip_tags($question->getElements()->content->value); ?>
                </p>
                <a href="<?= @route('option=com_maudhui&view=question&id='.$question->id); ?>" class="btn"><span>Answer Question</span></a>
            </div>
            <footer>
                <div class="row">
                    <div class="span1">
                        <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
                    </div>
                    <div class="span2 contributed-by">
                        <h1><?= $question->getUser()->name; ?></h1>
                        <time><?= @helper('date.humanize', array('date' => $question->created_on)); ?></time>
                    </div>
                </div>
            </footer>
        </article>
        <? endif; ?>
        <? endforeach; ?>
        <footer>
            <a href="<?= @route('view=conversations'); ?>"><?= @text('View All Questions & Answers'); ?></a>
        </footer>
    </section>
</div>