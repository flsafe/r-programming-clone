<?php
	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('showdown');
	echo $javascript->link('util', false);
	echo $javascript->link('jquery/comment');
	echo $javascript->link('jquery/topics', false);
 	echo $javascript->link('jquery/vote', false);

	
 	if(!isset($topic['User']))
		$topic['User']['username'] = "";
		
	$sanitizeUtil->htmlEsc($topic['Topic'], array('text'));
	
	$points  = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
	$topicid = $topic['Topic']['id'];
	$vote    = 'none';
	if(isset($uservotes[$topicid]))
		$vote = $uservotes[$topicid] ? 'up' : 'down';
	$showedit = false;
	if(isset($loggedin))
		$showedit = true;

	echo $this->element('topic', array('id'      => $topic['Topic']['id'],
																		'title'    => $topic['Topic']['title'],
																		'points'   => $points,
																		'username' => $topic['User']['username'],
																		'vote'     => $vote,
																		'showedit' => $showedit));
?>
<div id="topictext">
	<?php echo $markdown->parse($topic['Topic']['text']);?>
</div>

<?php
	echo $this->element('comments', array('modelname'=>'Topic', 
																				'model_id' => $topic['Topic']['id'],
																				'username' => $topic['User']['username'],
																				'user_id'  => $topic['User']['id']));
?>