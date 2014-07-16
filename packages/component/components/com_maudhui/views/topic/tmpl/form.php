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

<div class="row-fluid">
    <div class="span12" style="padding: 20px; background: #C9C9C9;">
        <form action="" class="-koowa-form form-vertical" method="post">
            <div class="control-group">
                <div class="controls">
                    <input name="title" placeholder="Title" style="width: 100%;">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <textarea name="content" placeholder="Start a community conversation..." style="width: 100%;"></textarea>
                </div>
            </div>
            <? if($conversation->isRelationable()) : ?>
            <div class="control-group">
                <div class="controls">
                    <?= @helper('com://admin/taxonomy.template.helper.listbox.taxonomies'); ?>
                </div>
            </div>
            <? endif; ?>
            <div class="control-group">
                <div class="controls">
                    <button class="btn pull-right" type="submit"><?= @text('Start the Conversation'); ?></button>
                </div>
            </div>
            <input type="hidden" name="maudhui_type_id" value="2">
        </form>
    </div>
</div>