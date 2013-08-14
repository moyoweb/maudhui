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

<h1>News</h1>
<? foreach($groups as $group) : ?>
    <div class="row">
        <div class="span9 group">
            <?= $group->title; ?>
            <? if($group->isElementable()) : ?>
                <p><?= $group->getElements()->content->value; ?></p>
            <? endif; ?>
        </div>
    </div>
<? endforeach; ?>