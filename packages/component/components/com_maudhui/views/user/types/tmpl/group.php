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

<?php if ($group->isElementable() && $group->isRelationable()): ?>
<?php $created_by = $group->getUser(); ?>
<section class="activity-feed">
    <header class="activity-header">
        <i class="icon-user"></i>
        <?php if ($created_by->id == $profile->id): ?>
        <a href="<?= @route('option=com_profile&view=user&id='.$user->id); ?>"><?= $user->name; ?></a> created the <a href="<?= @route('option=com_maudhui&view=group&id='.$group->id);?>"><?= $group->title;?></a> group
        <?php else: ?>
        <a href="<?= @route('option=com_profile&view=user&id='.$profile->id); ?>"><?= $profile->name; ?></a> joined the <a href="<?= @route('option=com_maudhui&view=group&id='.$group->id);?>"><?= $group->title;?></a> group
        <?php endif; ?>
        , <?= @date(array('date' => $group->created_on, 'format' => '%d %B %Y %H:%M')); ?>
    </header>
    <article class="activity-content">
        <h3><a href="<?= @route('option=com_maudhui&view=group&id='.$group->id);?>"><?= $group->title;?></a></h3>
        <p><?= $group->getElements()->content->value;?></p>

        <footer class="row-fluid">
            <span class="span4">
                Created by <a href="<?= @route('option=com_profile&view=user&id='.$user->id);?>"><?= $user->name; ?></a>
            </span>
            <span class="span1">
                <i class="icon-user"></i> 10
            </span>
            <span class="span4">
                <a class="btn" href="#"><?= @text('Join Group');?></a>
            </span>
        </footer>
    </article>
</section>
<?php endif; ?>