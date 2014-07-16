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

<? foreach($articles as $article) : ?>

    <? if($article->isElementable()) : ?>
        <div class="row">
            <div class="span6">
                <?= $article->getElements()->content->value; ?>
            </div>
            <div class="span3">
                <img src="<?= $article->getElements()->image->value; ?>" />
            </div>
        </div>
    <? endif; ?>

<? endforeach; ?>
