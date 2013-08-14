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

<? if($conversation->isElementable() && $conversation->isRelationable()) : ?>
<section>
    <header>
        <a href="<?= @route('option=com_profile&view=user&id='.$conversation->getUser()->id); ?>"><?= $conversation->getUser()->name; ?></a> started a conversation about <?= $conversation->title; ?>, <?= @date(array('date' => $conversation->created_on, 'format' => '%d %B %Y %H:%M')); ?>
    </header>
    <article class="row">
        <section class="span1">
            <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
        </section>
        <section class="span8 conversation arrow-left">
            <header>
                <h1><?= $conversation->getUser()->name; ?></h1>
            </header>
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