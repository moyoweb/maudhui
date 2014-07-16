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

<? if($conversation->isElementable() && $conversation->isRelationable()) : ?>

<div id="conversation" class="row">
    <section class="span9">
        <div class="row">
            <section class="span1">
                <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
            </section>
            <article class="span8 conversation arrow-left" style="background: #ffffff;">
                <header class="title">
                    <h1><?= $conversation->title ?></h1> <span class="small"><?= @text('by'); ?> <?= $conversation->getUser()->name; ?></span>
                </header>
                <p><?= $conversation->getElements()->content->value; ?></p>
                <? if($conversation->getParent(array('filter' => array('type' => 'article'))) &&
                    $conversation->getParent(array('filter' => array('type' => 'article')))->title) : ?>
                    <a href="<?= @route('&view=article&id='.$conversation->getParent(array('filter' => array('type' => 'article')))->id); ?>"><?= @text('Orginal Article'); ?>: <?= $conversation->getParent(array('filter' => array('type' => 'article')))->title; ?></a>
                <? endif; ?>
            </article>
        </div>
        <div class="row">
            <section class="offset1 span8 new reply">
                <form action="<?= @route('view=reply'); ?>" class="-koowa-form" method="post">
                    <strong><?= @text('Have Your Say'); ?></strong>
                    <div class="control-group">
                        <div class="controls">
                            <textarea name="content" style="width: 100%;" required></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button class="btn pull-right" type="submit"><span><?= @text('Post Your Response'); ?></span></button>
                        </div>
                    </div>
                    <input type="hidden" name="title" value="Reply">
                    <input type="hidden" name="parent" value="<?= $conversation->getTaxonomy()->id; ?>">
                    <input type="hidden" name="type" value="reply">
                    <input type="hidden" name="cck_fieldset_id" value="3">
                </form>
            </section>
        </div>
        <? foreach($conversation->getReplies() as $reply) :?>
            <? if($reply->isElementable()) : ?>
                <article class="row">
                    <section class="span1 avatar">
                        <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
                    </section>
                    <section class="span8 reply arrow-left">
                        <p><?= $reply->getElements()->content->value; ?></p>
                        <strong><a class="created-by" href="<?= @route('view=user&id='.$reply->created_by); ?>"><?= @text('By'); ?> <?= $reply->getUser()->name; ?>,</a></strong>
                        <time datetime="<?= @date(array('date' => $reply->created_on, 'format' => '%Y-%d-%m')); ?>"><?= @date(array('date' => $reply->created_on, 'format' => '%d %B %Y, %I:%M %p')); ?></time>
                    </section>
                </article>
                <? endif; ?>
            <? endforeach; ?>
        <? endif; ?>
    </section>
    <aside class="span3">
        <? if($topic) : ?>
        <div class="module">
            <header>
                <h1><?= sprintf(@text('This is part of the %s topic'), $topic->title); ?></h1>
            </header>
            <a class="btn" href="<?= @route('view=topics'); ?>"><span><?= @text('Follow this Topic'); ?></span></a>
            <a class="btn" href="<?= @route('view=topics'); ?>"><span><?= @text('Discover More Topics'); ?></span></a>
        </div>
        <? endif; ?>

        <? if($group) : ?>
        <div class="module">
            <header>
                <h1><?= sprintf(@text('This is part of the %s group'), $group->title); ?></h1>
            </header>
            <a class="btn" href="<?= @route('view=groups'); ?>"><span><?= @text('Discover More Groups'); ?></span></a>
        </div>
        <? endif; ?>
    </aside>
</div>