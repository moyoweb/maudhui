<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 * @uses        Com_cck, com_taxonomy
 */

defined('KOOWA') or die('Protected resource'); ?>

<?= @helper('behavior.mootools'); ?>

<script src="media://lib_koowa/js/koowa.js" />

<form action="" method="post" class="-koowa-form">
    <div id="main" class="grid_8">
        <div class="panel title clearfix">
            <input class="inputbox required" type="text" name="title" id="title" size="40" maxlength="255" value="<?= $type->title ?>" placeholder="<?= @text('Title') ?>" />
            <label for="slug"><?= @text('Slug') ?></label>
            <input class="inputbox" type="text" name="slug" id="slug" size="40" maxlength="255" value="<?= $type->slug ?>" placeholder="<?= @text('Slug') ?>" /><br />
        </div>
    </div>
    <div id="panels" class="grid_4">
        <div class="panel">
            <h3><?= @text('Publish') ?></h3>
            <table class="paramlist admintable">
                <tr>
                    <td class="paramlist_key">
                        <label><?= @text('Enabled') ?></label>
                    </td>
                    <td>
                        <?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $type->enabled)) ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="panel">
            <h3><?= @text('Details') ?></h3>
            <table width="100%" class="paramlist admintable" cellspacing="1">
                <tbody>
                    <tr>
                        <td width="40%" class="paramlist_key">
                            <label><?= @text('Fieldset') ?></label>
                        </td>
                        <td class="paramlist_value">
                            <?= @helper('com://admin/cck.template.helper.listbox.fieldsets'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</form>