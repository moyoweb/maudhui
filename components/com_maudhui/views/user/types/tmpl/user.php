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

<section class="activity-feed user">
    <header class="activity-header">
        <i class="icon-user"></i>
         <a href="<?= @route('option=com_profile&view=user&id='.$profile->id);?>"><?= $profile->name;?></a> made a connection with <a href="<?= @route('option=com_profile&view=user&id='.$user->id); ?>"><?= $user->name; ?></a>
    </header>
    <article class="body">
        <div class="row">
            <section class="span1">
                <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" />
            </section>
            <section class="span3">
                <h5><a href="<?= @route('option=com_profile&view=user&id='.$user->id);?>"><?= $user->name; ?></a></h5>
            </section>
            <section class="span4">
                <a class="btn" href="<?= @route('option=com_maudhui&view=conversation');?>"><?= @text('Start a Conversation');?></a>
                <?= @helper('com://site/profile.template.helper.connection.render', array(
                    'profile_id' => $user->id
                )); ?>
            </section>
        </div>
    </article>
</section>