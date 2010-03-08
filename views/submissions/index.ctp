<?php 
	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('util', false);
	echo  $javascript->link('jquery/submissions', false); #TODO: Kind of a hack. What's the better way?
	echo  $javascript->link('jquery/vote', false);
?>

<?php 
	$id       = $topic['Topic']['id'];
	$title    = $topic['Topic']['title'];
	$text     = $topic['Topic']['text'];
	$points   = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
	$username = $topic['User']['username'];
	
  $sanitizeUtil->htmlEsc($topic['Topic'], array('title','text'));

  echo $this->element('selectedtopic', array('title'=>$title, 'username'=>$username, 'text'=>$markdown->parse($text)));
?>

<a href="/today/add" title="Submit my solution to the puzzle above">
	<img	src="/img/postsolution.png" alt="Submit my solution to the puzzle above"/>
</a>

<?php
	echo $this->element('submissionslist', array('submissions'=> $models, 
																							 'uservotes'  => $uservotes,
																							 'user_id'    => $user_id));
?>




