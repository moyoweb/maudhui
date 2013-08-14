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

<section>
    <header>
        <a href="<?= @route('option=com_profile&view=user&id='.$user->id); ?>"><?= $user->name; ?></a> joined the <?= $group->title; ?>
    </header>
</section>