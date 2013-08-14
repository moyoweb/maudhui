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

<?php if($question->isElementable() && $question->isRelationable()) : ?>
<?php $created_by = $question->getUser(); ?>
<section class="activity-feed question">
    <header class="activity-header">
        <i class="icon-comment"></i>
        <?php if ($profile->id == $created_by->id): ?>
            <a href="<?= @route('option=com_profile&view=user&id='.$created_by->id);?>"><?= $created_by->name; ?></a> post a <a href="<?= @route('option=com_maudhui&viwe=question&id='.$question->id);?>">question</a>
        <?php else: ?>
        <a href="<?= @route('option=com_profile&view=user&id='.$profile->id); ?>"><?= $profile->name; ?></a> answer a <a href="<?= @route('option=com_maudhui&view=question&id='.$question->id);?>">question</a> created by <a href="<?= @route('option=com_profile&view=user&id='.$created_by->id);?>"><?= $created_by->name; ?></a>
        <?php endif; ?>
        , <?= @date(array('date' => $question->created_on, 'format' => '%d %B %Y %H:%M')); ?>
    </header>
    <article class="row">
        <section class="span1">
            <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
        </section>
        <section class="span8 body">
            <header>
                <h2><a href="<?= @route('option=com_maudhui&view=question&id='.$question->id);?>"><?= $question->title;?></a></h2>
            </header>

            <p><?= $question->getElements()->content->value; ?></p>

            <footer class="row-fluid">
                <div class="span7 count">
                    <?= @text('Last Contribution'); ?>: <time datetime="<?= @date(array('date' => $question->comment_on, 'format' => '%Y-%d-%m')); ?>"><?= @helper('date.humanize', array('date' => $question->comment_on)) ?></time>
                </div>
                <div class="span1 count"><i class="icon-user"></i> 10</div>
                <div class="span1 count"><i class="icon-comment"></i> <?= $question->getReplies()->count();?></div>
                <div class="span3">
                    <a class="btn pull-right" href="<?= @route('view=question&id='.$question->id); ?>"><div><?= @text('Join Conversation'); ?></div></a>
                </div>
            </footer>
        </section>
    </article>
</section>
<? endif; ?>