<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ComMaudhui
 * @uses        Com_cck, com_taxonomy
 */

defined('KOOWA') or die('Protected resource'); ?>

<? foreach($conversations as $conversation) : ?>

    <? if($conversation->isElementable()) : ?>
        <div class="row">
            <div class="span6">
            	<a href="<?= @route('index.php?option=com_maudhui&view=conversation&id='.$conversation->id) ?>">
                	<?= $conversation->title; ?>
	            <a>
            </div>
        </div>
    <? endif; ?>

<? endforeach; ?>