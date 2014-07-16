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

<? if($question->isElementable() && $question->isRelationable()) : ?>

<module title="Aside" position="aside" prepend="0" xmlns="http://www.w3.org/1999/html">
    <? foreach($question->getTopics() as $topic) :?>
        <? if($topic->isElementable()) : ?>
            <strong><?= sprintf(@text('This is part of the %s topic'), $topic->title); ?></strong>
            <a class="btn" href="<?= @route('view=topics'); ?>"><?= @text('Discover More Topics'); ?></a>
        <? endif; ?>
    <? endforeach; ?>

    <? foreach($question->getGroups() as $group) :?>
        <? if($group->isElementable()) : ?>
            <strong><?= sprintf(@text('This is part of the %s group'), $group->title); ?></strong>
            <a class="btn" href="<?= @route('view=groups'); ?>"><?= @text('Discover More Groups'); ?></a>
        <? endif; ?>
    <? endforeach; ?>
</module>

<div id="question" class="row">
    <section class="span9">
        <article>
            <div class="row">
                <section class="span1">
                    <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
                </section>
                <section class="span8 question arrow-left">
                    <? if($question->isElementable()) : ?>
                    <p><?= strip_tags($question->getElements()->content->value); ?> <span class="small"><strong><a class="created-by" href="<?= @route('view=user'); ?>"><?= @text('By'); ?> <?= $question->getUser()->name; ?></a></strong></small></p>
                    <? endif; ?>
                </section>
            </div>
        </article>
        <div class="row">
            <section class="offset1 span8 new reply">
                <form action="<?= @route('view=reply'); ?>" class="-koowa-form" method="post">
                    <strong><?= @text('Answer this Question'); ?></strong>
                    <div class="control-group">
                        <div class="controls">
                            <textarea name="content" style="width: 100%;" required></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button class="btn pull-right" type="submit"><span><?= @text('Post Your Answer'); ?></span></button>
                        </div>
                    </div>

                    <input type="hidden" name="title" value="Reply <?= $question->getReplies()->count() + 1; ?>">
                    <input type="hidden" name="parent" value="<?= $question->getTaxonomy()->id; ?>">
                    <input type="hidden" name="type" value="reply">
                    <input type="hidden" name="cck_fieldset_id" value="3">

                </form>
            </section>
        </div>
        <? foreach($question->getReplies() as $descendant) :?>
            <? if($descendant->isElementable()) : ?>
                <article class="row">
                    <section class="span1 avatar">
                        <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
                    </section>
                    <section class="span8 reply arrow-left">
                        <p><?= $descendant->getElements()->content->value; ?></p>
                        <span class="small"><strong><a class="created-by" href="<?= @route('view=user'); ?>"><?= @text('By'); ?> <?= $descendant->getUser()->name; ?></a></strong>,
                        <time datetime="<?= @date(array('date' => $descendant->created_on, 'format' => '%Y-%d-%m')); ?>"><?= @date(array('date' => $descendant->created_on, 'format' => '%d %B %Y, %I:%M %p')); ?></time></span>
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