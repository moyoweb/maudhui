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

<div class="row">
    <section class="span12">
        <header>
            <h1>Topics</h1>
        </header>
    </section>
</div>
<div class="row">
    <section class="span9 topics">

        <? foreach($topics as $topic) : ?>
        <article class="row-fluid topic">
            <div class="span8">
                <header>
                    <h1><a href="<?= @route('view=topic&id='.$topic->id); ?>"><?= $topic->title; ?></a></h1>
                </header>
                <? if($topic->isElementable()) : ?>
                <p><?= strip_tags($topic->getElements()->content->value); ?></p>
                <? endif; ?>
            </div>
            <div class="span4">
                <div class="btn-group pull-right">
                    <button class="btn" type="button"><span><?= @text('Follow'); ?></span></button>
                </div>
            </div>
        </article>
        <? endforeach; ?>
        <footer>
            <?= @helper('paginator.pagination', array('total' => $total)) ?>
        </footer>
    </section>
    <aside class="span3">
        <div class="module">
            <a class="btn btn-primary" href="<?= @route('&filter=conversations'); ?>"><span><?= @text('All Topics'); ?></span></a>
            <a class="btn btn-primary" href="<?= @route('view=user&type=topics'); ?>"><span><?= @text('My Topics'); ?></span></a>
        </div>
    </aside>
</div>