<?php 
	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('util', false);
	echo  $javascript->link('jquery/submissions', false); #TODO: Kind of a hack. What's the better way?
	echo  $javascript->link('jquery/vote', false);
?>

<?php 
  $sanitizeUtil->htmlEsc($topic['Topic'], array('title','text'));
	$text = $markdown->parse($topic['Topic']['text']);
  echo $this->element('selectedtopic', array('title'           => $topic['Topic']['title'], 
																						 'username'        => $topic['User']['username'], 
																						 'text'            => $text,
																						  'datastructures' => $topic['DataStructure'],
																						  'algorithms'     => $topic['Algorithm']));
?>

<a href="/today/add" title="Submit my solution to the puzzle above">
	<img	src="/img/postsolution.png" alt="Submit my solution to the puzzle above"/>
</a>

<?php
	echo $this->element('submissionslist', array('submissions'=> $models, 
																							 'uservotes'  => $uservotes,
																							 'user_id'    => $user_id));
?>




