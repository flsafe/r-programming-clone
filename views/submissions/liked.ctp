<h1>The Solutions You Upvoted</h1>
<?php #Show the user all the submissions they upvoted
	echo $this->element('submissionslist', array('submissions'=>$submissions,
																							'uservotes'=>$uservotes,
																							'loggedin'=> true));
?>