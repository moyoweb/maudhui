<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 */

defined('KOOWA') or die('Protected resource'); ?>

<script>
    jQuery.noConflict()(function($){
        //$('#myTab a:last').tab('show');

        $('.follow').on('click', function(){
            $.ajax({
                type: "POST",
                url: "<?= @route('&view=topic&id='.$topic->id); ?>",
                data: { action: "follow", _token: "<?= JUtility::getToken(); ?>" }
            })
        });
    })
</script>

<? if($topic->isRelationable()) : ?>

<module title="Aside" position="aside" prepend="0">
    <button class="btn follow" type="button" "><?= @text('Follow this Topic'); ?></button>
    <pre>
        <?= $topic->getUsers()->count(); ?>
    </pre>
</module>

<div id="topic">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a class="btn gigas" href="#conversations"><span><?= @text('Conversations'); ?></span></a></li>
        <li><a class="btn picton-blue" href="#questions"><span><?= @text('Questions & Answers'); ?></span></a></li>
        <li><a class="btn endeavour" href="#news"><span><?= @text('News'); ?></span></a></li>
        <li><a class="btn tangerine" href="#events"><span><?= @text('Events'); ?></span></a></li>
        <li><a class="btn" href="#resources"><span><?= @text('Resources'); ?></span></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="conversations">
            <h1><?= @text('Conversations'); ?></h1>
            <div class="row">
                <div class="span9">
                    <? foreach($topic->getConversations() as $conversation) : ?>
                    <? if($conversation->isElementable() && $conversation->isRelationable()) : ?>
                        <article class="row" style="margin-top: 20px">
                            <section class="span1">
                                <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
                            </section>
                            <section class="span8 conversation arrow-left">
                                <p>
                                    <?= strip_tags($conversation->getElements()->content->value); ?>
                                    <span class="small"><strong><a class="created-by" href="<?= @route('view=user'); ?>"><?= @text('By'); ?> <?= $conversation->getUser()->name; ?></a></strong></span>
                                </p>
                                <? $parent = $conversation->getParent(array('filter' => array('type' => 'article'))); ?>
                                <? if($parent->title) : ?>
                                    <a href="<?= @route('view=article&id='.$parent->id); ?>"><?= @text('Orginal Article'); ?>: <?= $parent->title; ?></a>
                                <? endif; ?>
                                <footer>
                                    <?= @text('Last Contribution'); ?>: <time datetime="<?= @date(array('date' => $conversation->comment_on, 'format' => '%Y-%d-%m')); ?>"><?= @helper('date.humanize', array('date' => $conversation->comment_on)) ?></time>
                                    <a class="btn pull-right" href="<?= @route('view=conversation&id='.$conversation->id); ?>"><span><?= @text('Join the Conversation'); ?></span></a>
                                    <p>Replies <?= $conversation->comments ?></p>
                                </footer>
                            </section>
                        </article>
                    <? endif; ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="questions">...</div>
        <div class="tab-pane" id="news">...</div>
        <div class="tab-pane" id="events">...</div>
        <div class="tab-pane" id="resources">...</div>
    </div>
</div>
<? endif; ?>