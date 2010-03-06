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

<?php echo $this->element('topic', array('topic'   => $topic,
																				 'user_id' => $user_id)); ?>

<div id="topictext">
	<?php 
		$sanitizeUtil->htmlEsc($topic['Topic'], array('text'));
		echo $markdown->parse($topic['Topic']['text']);
	?>
</div>

<?php
	echo $this->element('comments', array('modelname'=>'Topic', 
																				'model_id' => $topic['Topic']['id'],
																				'username' => $topic['User']['username'],
																				'user_id'  => $topic['User']['id']));
?>