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

<script>
    jQuery.noConflict()(function($){
        $('button.subscribe').on('click', function() {
            var id = $(this).attr('data-id');
            var action = $(this).attr('data-action');
            $.ajax({
                type: "POST",
                url: "<?= @route('&view=group&id='); ?>" + id,
                data: { action: action, _token: "<?= JUtility::getToken(); ?>" }
            });
        });
    });
</script>

<div class="row">
    <section class="span12">
        <header>
            <h1>Groups</h1>
        </header>
    </section>
</div>

<div class="row">
    <section class="span9 groups">
        <? foreach($groups as $group) : ?>
            <article class="row-fluid group">
                <div class="span8">
                    <header>
                        <h1><a href="<?= @route('view=group&id='.$group->id); ?>"><?= $group->title; ?></a></h1>
                    </header>
                    <? if($group->isElementable()) : ?>
                        <p><?= strip_tags($group->getElements()->content->value); ?></p>
                    <? endif; ?>
                </div>
                <div class="span4">
                    <div class="btn-group pull-right">
                        <button class="btn" type="button"><span><?= @text('Join Group'); ?></span></button>
                    </div>
                </div>
            </article>
        <? endforeach; ?>
        <footer>
            <?= @helper('paginator.pagination', array('total' => $total)) ?>
        </footer>
    </section>
    <aside class="span3">
        <div class="module">
            <a href="<?= @route('view=group'); ?>" class="btn btn-primary"><span><?= @text('Create a New Group'); ?></span></a>
        </div>
    </aside>
</div>