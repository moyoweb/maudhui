<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 */

defined('KOOWA') or die('Protected resource');

// Get the users taxonomy
$user_tax = $this->getService('com://admin/taxonomy.model.taxonomy')
                ->row(JFactory::getUser()->id)
                ->table('profile_users')
                ->getItem();

// Get the trust taxonomy
if ($group->isRelationable()) {
    $group_tax = $group->getTaxonomy();
}

// Test isDecendantOf
$joined = $user_tax->isDescendantOf($group_tax);


?>
<script>
    jQuery.noConflict()(function($){
        $('.join').on('click', function(){
            var action = ($('.join').data('state') == "joined") ? 'leave' : 'join';
            $.ajax({
                type: "POST",
                url: "<?= @route('&view=group&id='.$group->id); ?>",
                data: { action: action, _token: "<?= JUtility::getToken(); ?>" },
                complete: function(data, response){

                    if(data.responseText == "success") {
                        var new_state = ($('.join').data('state') == "joined") ? 'left' : 'joined';
                        var new_value = (action == "join") ? 'Leave this Group' : 'Join this Group';
                        $('.join').data('state', new_state);
                        $('.join .ui-btn-text').text(new_value);
                    }
                }
            })
        });
    })
</script>

<div class="row">
    <section class="span9">
        <div id="group">
        <? if($group->isElementable() && $group->isRelationable()) : ?>
            <? foreach($group->getRelation(array('limit' => 10, 'filter' => array('type' =>  KInflector::singularize($state->filter)))) as $relation) : ?>
                <?= @template('com://site/maudhui.view.group.types.'.$relation->type, array($relation->type => $relation)); ?>
            <? endforeach; ?>
        <? endif; ?>
        </div>
    </section>
    <aside class="span3">
        <div class="module">
            <a data-state="<?= $joined ? 'joined' : 'left' ?>" class="join" data-role="button" data-theme="a" data-icon="arrow-r" data-iconpos="right"><span><?= $joined ? @text('Leave this Group') : @text('Join this Group'); ?></span></a>
            <a class="btn" href="<?= @route('view=conversation'); ?>"><span><?= @text('Start a Conversation'); ?></span></a>
        </div>
        <div class="module">
            <header>
                <h1><?= @text('Filter Activity'); ?></h1>
            </header>
            <a class="btn" href="<?= @route('&filter=conversations'); ?>"><span><?= @text('Conversations'); ?></span></a>
            <a class="btn" href="<?= @route('&filter=questions'); ?>"><span><?= @text('Questions & Answers'); ?></span></a>
            <a class="btn" href="<?= @route('&filter=replies'); ?>"><span><?= @text('Replies'); ?></span></a>
         </div>
    </aside>
</div>