<?php
	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('showdown');
	echo $javascript->link('util', false);
	echo $javascript->link('jquery/comment');
	echo $javascript->link('jquery/topics', false);
 	echo $javascript->link('jquery/vote', false);
	
 	if(!isset($topic['User']))
		$topic['User']['username'] = "";
?>

<h1 id="pagetitleheader">View Puzzle</h1>

<?php echo $this->element('topic', array('topic'   => $model,
																				 'user_id' => $user_id)); ?>

<div id="topictext">
	<?php 
		$sanitizeUtil->htmlEsc($model['Topic'], array('text'));
		echo $markdown->parse($model['Topic']['text']);
	?>
</div>

<?php
	echo $this->element('comments', array('modelname'=>'Topic', 
																				'model_id' => $model['Topic']['id'],
																				'username' => $model['User']['username'],
																				'user_id'  => $model['User']['id']));
?>