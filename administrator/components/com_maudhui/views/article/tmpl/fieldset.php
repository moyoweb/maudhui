<?php
/**
 * Com ......
 *
 * @author      Kyle Waters <development@organic-development.com>
 * @category    Com_***
 * @package     ******
 * @uses        Com_
 */
 
 defined('KOOWA') or die('Protected resource');
?>

<?= @service('com://admin/cck.controller.element')->cck_fieldset_id(KRequest::get('get.cck_fieldset_id', 'int'))->row($article->id)->table('maudhui_articles')->getView()->assign('row', $article)->layout('list')->display(); ?>