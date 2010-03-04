<h1>Vote On Tommorrow's Puzzle!</h1>

<?php 
	echo $javascript->link('jquery/jquery.min', false);
 	echo $javascript->link('jquery/topics', false);
	echo $javascript->link('util', false);
 	echo $javascript->link('jquery/vote', false);
?>

<a href="/topics/add"><img src="/img/submittopic.png" alt="submit topic" title="submittopic"></a>

		<?php echo $this->element('topicslist', array('topics'    => $topics,
																						      'uservotes' => $uservotes,
																						      'loggedin'  => $loggedin)) 
		?>
