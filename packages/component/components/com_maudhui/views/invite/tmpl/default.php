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

<form action="" class="form-vertical" method="post">
    <? foreach($friends as $friend) : ?>
        <div class="control-group">
            <div class="controls">
                <input type="checkbox" name="id[]" value="<?= $friend->id; ?>">
                <label><?= $friend->name ?></label>
            </div>
        </div>
    <? endforeach; ?>
    <div class="control-group">
        <div class="controls">
            <button type="submit"><?= @text('Invite'); ?></button>
        </div>
    </div>
    <input type="hidden" name="action" value="invite">
    <input type="hidden" name="parent_id" value="<?= KRequest::get('get.parent_id', 'int'); ?>">
</form>