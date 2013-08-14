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
HI
<div class="row-fluid">
    <div class="span12" style="padding: 20px; background: #C9C9C9;">
        <form action="" class="-koowa-form form-vertical" method="post">
            <div class="control-group">
                <div class="controls">
                    <input type="text" name="title" placeholder="Question title" style="width: 100%;" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <textarea name="content" placeholder="Enter your question here...." style="width: 100%;" class="required"></textarea>
                </div>
            </div>

            <? if($question->isRelationable()) : ?>
            <div class="control-group">
                <div class="controls">
                    <?= @helper('com://admin/taxonomy.template.helper.listbox.taxonomies', array('name' => 'topic', 'filter' => array('type' => 'topic'))); ?>
                </div>
            </div>
            <? endif; ?>

            <div class="control-group">
                <div class="controls">
                    <button class="btn pull-right" type="submit">
                        <span><?= @text('Ask your Question'); ?></span>
                        <i class="icon-play-sign"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="type" value="question">
            <input type="hidden" name="parent" value="<?= $state->parent; ?>">
            <input type="hidden" name="cck_fieldset_id" value="3">
        </form>
    </div>
</div>