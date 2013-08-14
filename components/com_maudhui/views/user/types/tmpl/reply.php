<?php
/**
 * ComMaudhui
 *
 * @author      Allan Pilarca <allan@wizmediateam.com>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 */

defined('KOOWA') or die('Protected resource'); ?>

<?php if($reply->isElementable() && $reply->isRelationable()) : ?>
    <?php $conversation = $reply->getParent(); ?>
    <?php $created_by   = $conversation->getUser(); ?>
    <?php $reply_by     = $reply->getUser(); ?>
    <?php if($conversation->isElementable() && $conversation->isRelationable()) : ?>
    <section class="activity-feed conversation">
        <header class="activity-header">
            <a href="<?= @route('option=com_profile&view=user&id='.$reply_by->id); ?>"><?= $reply_by->name; ?></a> posted a reply in the <a href="<?= @route('view=conversation&id='.$conversation->id); ?>">conversation</a> created by <a href="<?= @route('option=com_profile&view=profile&id='.$created_by->id); ?>"><?= $created_by->name; ?></a>, <?= @date(array('date' => $reply->created_on, 'format' => '%d %B %Y %H:%M')); ?>
        </header>
        <article class="row">
            <section class="span1">
                <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
            </section>
            <section class="span8 body">
                <strong><?= $conversation->getUser()->name; ?></strong>
                <p><?= $conversation->getElements()->content->value; ?></p>
                <? $parent = $conversation->getParent(array('filter' => array('type' => 'article'))); ?>
                <? if($parent->title) : ?>
                    <a href="<?= @route('view=article&id='.$parent->id); ?>"><?= @text('Orginal Article'); ?>: <?= $parent->title; ?></a>
                <? endif; ?>
                <footer class="row-fluid">
                    <div class="span7 count">
                        <?= @text('Last Contribution'); ?>: <time datetime="<?= @date(array('date' => $conversation->comment_on, 'format' => '%Y-%d-%m')); ?>"><?= @helper('date.humanize', array('date' => $conversation->comment_on)) ?></time>
                    </div>
                    <div class="span1 count"><i class="icon-user"></i> 10</div>
                    <div class="span1 count"><i class="icon-comment"></i> <?= $conversation->getReplies()->count();?></div>
                    <div class="span3">
                        <a class="btn pull-right" href="<?= @route('view=conversation&id='.$conversation->id); ?>"><div><?= @text('Join Conversation'); ?></div></a>
                    </div>
                </footer>
            </section>
        </article>
    </section>
    <?php endif; ?>
<?php endif; ?>