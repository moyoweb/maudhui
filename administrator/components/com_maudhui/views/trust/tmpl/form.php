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
HELLO
<?= @helper('behavior.keepalive'); ?>
<?= @helper('behavior.validator'); ?>
<?= @helper('behavior.mootools'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<script src="http://code.jquery.com/jquery-1.8.3.min.js" />

<script>
    jQuery.noConflict()(function($){
        $('select[name="maudhui_type_id"]').change(function () {
            $.get('index.php?option=com_maudhui&view=type&id=' + $(this).val() + '&format=json', {})
                .done(function(data) {
                    if(typeof tinymce != 'undefined') {
                        for (var i = 0; i < tinymce.editors.length; i++) {
                            tinyMCE.execCommand('mceRemoveControl', false, tinymce.editors[i].id);
                        };
                    };
                    $('#fieldset').load('index.php?option=com_cck&view=elements&cck_fieldset_id=' + data.item.cck_fieldset_id +'&layout=list&tmpl=component');
                });
        });
    });
</script>

<style>
    #editor-xtd-buttons, #editor-toggle-buttons {
        float: none !important;
    }

    #editor-xtd-buttons:after, #editor-toggle-buttons:after {
        clear: both;
        content: '.';
        display: block;
        visibility: hidden;
        height: 0;
    }
</style>

<form action="" method="post" class="-koowa-form">
    <div id="main" class="grid_8">
        <div class="panel title clearfix">
            <input class="inputbox required" type="text" name="title" id="title" size="40" maxlength="255" value="<?= $article->title ?>" placeholder="<?= @text('Title') ?>" />
            <label for="slug"><?= @text('Slug') ?></label>
            <input class="inputbox" type="text" name="slug" id="slug" size="40" maxlength="255" value="<?= $article->slug ?>" placeholder="<?= @text('Slug') ?>" /><br />
            <label for="slug"><?= @text('Subtitle') ?></label>
            <input class="inputbox" type="text" name="subtitle" id="subtitle" size="40" maxlength="255" value="<?= $article->subtitle ?>" placeholder="<?= @text('Subtitle') ?>" />
        </div>

        <div id="fieldset">
            <?= @service('com://admin/cck.controller.element')->cck_fieldset_id($article->cck_fieldset_id ? $article->cck_fieldset_id : 3)->row($article->id)->table('maudhui_articles')->layout('list')->display(); ?>
        </div>
    </div>
    <div id="panels" class="grid_4">
        <div class="panel">
            <h3><?= @text('Publish') ?></h3>
            <table class="paramlist admintable">
                <tr>
                    <td class="paramlist_key">
                        <label><?= @text('Published') ?></label>
                    </td>
                    <td>
                        <?= @helper('select.booleanlist', array('name' => 'state', 'selected' => $article->enabled)) ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="panel">
            <h3><?= @text('Details') ?></h3>
            <table width="100%" class="paramlist admintable" cellspacing="1">
                <tbody>
                <tr>
                    <td class="paramlist_key">
                        <label><?= @text('Type') ?></label>
                    </td>
                    <td>
                        <?= @helper('com://admin/maudhui.template.helper.listbox.types', array('selected' => $article->maudhui_type_id)); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</form>