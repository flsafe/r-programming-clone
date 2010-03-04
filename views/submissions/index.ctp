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
	echo $this->element('contentmenu');
	if(!isset($uservotes))
		$uservotes = array();
	echo $this->element('submissionslist', array('submissions'=> $submissions, 
																							 'uservotes'  => $uservotes,
																							 'loggedin'   => $loggedin));
?>




