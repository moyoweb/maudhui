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
            <th width="8%">
                <?= @helper('grid.sort', array('title' => 'Type', 'column' => 'type')) ?>
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
        <? foreach($articles as $article) : ?>
        <tr>
            <td align="center">
                <?= @helper('grid.checkbox' , array('row' => $article)) ?>
            </td>
            <td>
                <a href="<?= @route('view=article&id='.$article->id) ?>">
                    <?= @escape($article->title) ?>
                </a>
            </td>
            <td>
                <?= ucfirst(@escape($article->type)) ?>
            </td>
            <td>
                <?= @helper('date.humanize', array('date' => $article->created_on)) ?>
            </td>
        </tr>
            <? endforeach ?>
        </tbody>
    </table>
</form>