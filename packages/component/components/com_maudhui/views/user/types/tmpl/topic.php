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

<?php if($topic->isElementable() && $topic->isRelationable()) : ?>
<?php $created_by = $topic->getUser(); ?>
<section class="activity-feed topic">
    <header class="activity-header">
        <i class="icon-comment"></i>
        <?php if ($profile->id == $created_by->id): ?>
            <a href="<?= @route('option=com_profile&view=user&id='.$created_by->id);?>"><?= $created_by->name; ?></a> created the <?= $topic->title; ?> topic
        <?php else: ?>
        <a href="<?= @route('option=com_profile&view=user&id='.$profile->id); ?>"><?= $profile->name; ?></a> followed the <a href="<?= @route('option=com_maudhui&view=topic&id='.$topic->id);?>">topic</a>
        <?php endif; ?>
        , <?= @date(array('date' => $topic->created_on, 'format' => '%d %B %Y %H:%M')); ?>
    </header>
    <article class="body">
    	<div class="row">
	    	<section class="span7">
	            <header>
	                <h2><a href="<?= @route('option=com_maudhui&view=topic&id='.$topic->id);?>"><?= $topic->title;?></a></h2>
	            </header>
	            <p><?= $topic->getElements()->content->value; ?></p>
	    	</section>
	    	<section class="span1">
				<a class="btn pull-right" href="<?= @route('view=topic&id='.$topic->id); ?>"><div><?= @text('Follow'); ?></div></a>
	    	</section>
    	</div>
    </article>
</section>
<? endif; ?>