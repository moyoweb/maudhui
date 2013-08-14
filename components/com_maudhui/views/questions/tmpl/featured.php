<?php
/**
 * Com
 *
 * @author      Kyle Waters <development@organic-development.com>
 * @category
 * @package
 * @uses
 */

defined('KOOWA') or die();
$date   = date('d F Y', strtotime($questions->created_on));
$avatar = $this->getService('com://admin/profile.model.users')->set('id', $questions->created_by)->getItem()->avatar;
?>

<div class="userimg"><img src="<?= $avatar; ?>" class="avatar-small" /></div>
<div class="inner-content-right">
	<h2>Question of the Day</h2>
	<div>
		<span class="date">Asked by: <?= $questions->getUser()->name; ?>,</span>
		<span class="author">Date: <?= $date ?></span>
	</div>

	<p><?= $questions->title; ?></p>

	<div class="float-right clearfix" style="margin-left: -20%;">
		<div class="comments-count-btn float-left">
			<a href="#" data-role="button" data-icon="light" data-shadow="false"><?= $questions->comments ?></a>
		</div>
		<div class="float-left">
			<a href="<?= @route('index.php?option=com_maudhui&view=question&format=html&id='.$questions->id) ?>" data-role="button" data-icon="arrow-r" data-iconpos="right">View Question</a>
		</div>
	</div>
</div>
