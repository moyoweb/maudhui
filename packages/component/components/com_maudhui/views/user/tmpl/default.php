<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 * @uses        Com_cck, com_taxonomy
 */

defined('KOOWA') or die('Protected resource'); ?>

<? if($user->isElementable() && $user->isRelationable()) : ?>
<div class="row">
    <section class="span12">
        <header>
            <h1><?= @text(ucfirst($state->type)); ?></h1>
        </header>
    </section>
</div>
<div class="row">
    <section class="span9 <?= $state->type; ?>">
        <? foreach($user->getRelation(array('type' => 'ancestors', 'filter' => array('type' => KInflector::singularize($state->type)))) as $row) : ?>
            <article class="row-fluid <?= KInflector::singularize($state->type); ?>">
                <div class="span8">
                    <header>
                        <h1><a href="<?= @route('view=topic&id='.$row->id); ?>"><?= $row->title; ?></a></h1>
                    </header>
                    <? if($row->isElementable()) : ?>
                        <p><?= strip_tags($row->getElements()->content->value); ?></p>
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
            <?= @helper('paginator.pagination', array('total' => $user->get)) ?>
        </footer>
    </section>
    <aside class="span3">
        <div class="module">
            <a class="btn btn-primary" href="<?= @route('view='.$state->type); ?>"><span><?= @text('All '.ucfirst($state->type)); ?></span></a>
            <a class="btn btn-primary" href="<?= @route('view=user&type='.$state->type); ?>"><span><?= @text('My '.ucfirst($state->type)); ?></span></a>
        </div>
    </aside>
</div>
<? endif; ?>