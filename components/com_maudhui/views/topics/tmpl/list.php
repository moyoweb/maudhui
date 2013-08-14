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

<ul>

    <? foreach($topics as $topic) : ?>

        <li class="<?= $topic->slug ?>">
            <a data-role="button" data-icon="gear" href="<?= @route('index.php?option=com_maudhui&view=topic&id='.$topic->id) ?>"><?= $topic->title ?></a>
        </li>

    <? endforeach; ?>

</ul>