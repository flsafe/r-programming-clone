<h1>Your Puzzles</h1>
<?php
	echo $this->element('topicslist', array('topics'         => $topics,
																							 'uservotes' => $uservotes,
																						   'loggedin'  => true));
?>