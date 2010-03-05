
<?php #Show the user all the submissions they upvoted
	if($liked)
		echo $html->tag('h1', "Solutions You Liked");
	else
		echo $html->tag('h1', "Solutions You Didn't Like");

	echo $this->element('submissionslist', array('submissions'=> $submissions,
																							'uservotes'   => $uservotes,
																							'loggedin'    => true));
?>