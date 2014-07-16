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

defined('KOOWA') or die('Protected resource');

?>
<module title="Aside" position="aside" prepend="0" xmlns="http://www.w3.org/1999/html">
    <a class="btn" href="<?= @route('view=conversation&parent='.$article->id); ?>"><?= @text('Discuss this News Item'); ?></a>
</module>

<? if($article->isElementable()) : ?>
<article>
    <header>
        <h1><?= $article->title; ?></h1>
        <div class="row-fluid meta">
            <div class="span5 author">
                <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" align="left" />
                <p>Written By <?= $article->getUser()->name; ?></p>
            </div>
            <div class="span7 date">
                <time datetime="<?= @date(array('date' => $article->created_on, 'format' => '%Y-%d-%m')); ?>"><?= @date(array('date' => $article->created_on, 'format' => '%d %B %Y')); ?></time>
            </div>
        </div>
    </header>
    <div class="body">
        <img src="<?= $article->getElements()->image->value; ?>" align="right" />
        <?= $article->getElements()->content->value; ?>
    </div>
</article>
<? endif; ?>

<div class="row">
    <div class="span12">
        <h2 style="margin-left: 20px;">The community are talking about this...</h2>
        <div class="row">
            <? if($article->isRelationable()) : ?>
            <? foreach($article->getConversations(array('limit' => 4)) as $conversation) : ?>
                <? if($conversation->isElementable()) : ?>
                <div class="span3 conversations">
                    <div class="row">
                        <div class="span3 conversation arrow-down">
                            <p><?= $conversation->getElements()->content->value; ?></p>
                            <a class="btn" href="<?= @route('&view=conversation&id='.$conversation->id); ?>"><?= @text('Join the Conversation'); ?></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span3 author">
                            <img src="http://res.cloudinary.com/demo/image/facebook/w_55,h_55,c_fill,d_avatar.png/non_existing_id.jpg" align="left" />
                            <p><?= $conversation->getUser()->name; ?></p>
                        </div>
                    </div>
                </div>
                <? endif; ?>
            <? endforeach; ?>
            <? endif; ?>
        </div>
    </div>
</div>