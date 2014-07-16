<?php
/**
 * Com
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ...
 * @uses        Com_
 */

defined('KOOWA') or die('Protected resource'); ?>

<? if($reply->isElementable() && $reply->isRelationable()) : ?>
    <? $conversation = $reply->getParent(); ?>
    <? if($conversation->isElementable() && $conversation->isRelationable()) : ?>
    <section>
        <header>
            <a href="<?= @route('option=com_profile&view=user&id='.$reply->getUser()->id); ?>"><?= $reply->getUser()->name; ?></a> posted a reply in the <a href="<?= @route('view=conversation&id='.$conversation->id); ?>">conversation</a> <?= $conversation->title; ?> created by <a href="<?= @route('option=com_profile&view=profile&id='.$reply->getUser()->id); ?>"><?= $conversation->getUser()->name; ?></a>, <?= @date(array('date' => $reply->created_on, 'format' => '%d %B %Y %H:%M')); ?>
        </header>
        <article class="row">
            <section class="span1">
                <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
            </section>
            <section class="span8 conversation arrow-left">
                <strong><?= $conversation->getUser()->name; ?></strong>
                <p><?= $conversation->getElements()->content->value; ?></p>
                <? $parent = $conversation->getParent(array('filter' => array('type' => 'article'))); ?>
                <? if($parent->title) : ?>
                    <a href="<?= @route('view=article&id='.$parent->id); ?>"><?= @text('Orginal Article'); ?>: <?= $parent->title; ?></a>
                <? endif; ?>
                <footer>
                    <?= @text('Last Contribution'); ?>: <time datetime="<?= @date(array('date' => $conversation->comment_on, 'format' => '%Y-%d-%m')); ?>"><?= @helper('date.humanize', array('date' => $conversation->comment_on)) ?></time>
                    <a class="btn pull-right" href="<?= @route('view=conversation&id='.$conversation->id); ?>"><span><?= @text('Join the Conversation'); ?></span></a>
                    <p>Replies <?= $conversation->comments; ?></p>
                </footer>
            </section>
        </article>
    </section>
    <? endif; ?>
<? endif; ?>