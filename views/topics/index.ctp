<h1 id="pagetitleheader">Vote On Tommorrow's Puzzle!</h1>

<?php 
	echo $javascript->link('jquery/jquery.min', false);
 	echo $javascript->link('jquery/topics', false);
	echo $javascript->link('util', false);
 	echo $javascript->link('jquery/vote', false);
?>

<a href="/puzzles/add"><img src="/img/postpuzzle.png" alt="submit topic" title="submittopic"></a>

		<?php echo $this->element('topicslist', array('topics'    => $models,
																						      'uservotes' => $uservotes,
																						      'user_id'   => $user_id)) 
		?>
