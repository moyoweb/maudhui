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

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />

<form action="<?= @route(); ?>" class="-koowa-grid" method="get">
    <table class="adminlist">
        <thead>
        <tr>
            <th width="10"></th>
            <th>
                <?= @helper('grid.sort', array('column' => 'title')) ?>
            </th>
            <th width="8%">
                <?= @helper('grid.sort', array('title' => 'Date', 'column' => 'created')) ?>
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="3">
                <?= @helper('paginator.pagination', array('total' => $total)) ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <? foreach($types as $type) : ?>
        <tr>
            <td align="center">
                <?= @helper('grid.checkbox' , array('row' => $type)) ?>
            </td>
            <td>
                <a href="<?= @route('view=type&id='.$type->id) ?>">
                    <?= @escape($type->title) ?>
                </a>
            </td>
            <td>
                <?= @helper('date.humanize', array('date' => $type->created_on)) ?>
            </td>
        </tr>
            <? endforeach ?>
        </tbody>
    </table>
</form>