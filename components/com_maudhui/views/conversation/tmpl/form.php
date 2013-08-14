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
        <form action="<?= @route('view=conversation'); ?>" class="form-vertical" method="post">
            <div class="control-group">
                <div class="controls">
                    <input name="title" placeholder="Title" style="width: 100%;" class="required">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <textarea name="content" placeholder="Start a community conversation..." style="width: 100%;" class="required"></textarea>
                </div>
            </div>

            <? if($conversation->isRelationable()) : ?>
            <div class="control-group">
                <div class="controls">
                    <?= @helper('com://admin/taxonomy.template.helper.listbox.taxonomies', array('name' => 'topic', 'filter' => array('type' => 'topic'))); ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?= @helper('com://admin/taxonomy.template.helper.listbox.taxonomies', array('name' => 'group', 'filter' => array('type' => 'group'))); ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?= @helper('com://admin/acl.template.helper.listbox.access'); ?>
                </div>
            </div>
            <? endif; ?>

            <div class="control-group">
                <div class="controls">
                    <button class="btn pull-right" type="submit"><?= @text('Start the Conversation'); ?></button>
                </div>
            </div>
            <input type="hidden" name="type" value="conversation">
            <? if($state->parent) : ?>
            <input type="hidden" name="parent" value="<?= $state->parent; ?>">
            <? endif; ?>
            <input type="hidden" name="maudhui_type_id" value="2">
        </form>
    </div>
</div>