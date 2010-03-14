<?php
	#This is the home page. It shows the topic of the day, and all the submissions for that topic
	
	echo $this->element('javascriptvote', array('votingFor'=>'submissions'));
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
	<img	src="/img/postsolution.png" alt="Submit my solution to the puzzle above" width="110" height="27"/>
</a>

<?php
	echo $this->element('submissionslist', array('submissions'=> $models, 
																							 'uservotes'  => $uservotes,
																							 'user_id'    => $user_id));
?>




