<h1>Your Solutions</h1>
<?php
	echo $this->element('submissionslist', array('submissions' => $submissions,
																							 'uservotes'   => $uservotes,
																						   'loggedin'    => true));
?>