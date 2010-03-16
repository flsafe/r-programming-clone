<?php
	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('showdown');
	echo $javascript->link('util', false);
	echo $javascript->link('json2min', false); #TODO, put the comment includes in an element, and the vote includes in a different element
	echo $javascript->link('jquery/comment');
	echo $javascript->link('jquery/topics', false);
 	echo $javascript->link('jquery/vote', false);
?>

<?php echo $this->element('topic', array('topic'         => $model,
																				 'user_id'       => $user_id,
																				 'showeverything'=>false)); ?>

<div id="topictext">
	<?php 
		$sanitizeUtil->htmlEsc($model['Topic'], array('text'));
		echo $markdown->parse($model['Topic']['text']);
	?>
</div>

<?php
	echo $this->element('topicdatastructs', array('algorithms'    =>$model['Algorithm'],
																					 			'datastructures'=>$model['DataStructure']));
																					
	echo $this->element('comments', array('model'     => $model,
																				'modelname' => 'Topic',
																				'user_id'   => $user_id));
?>