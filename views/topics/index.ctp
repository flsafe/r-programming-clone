<h2 id="pagetitleheader">Vote On Tommorrow's Puzzle!</h2>

<?php 
	$this->element('javascriptvote', array('votingFor'=>'topics'));
?>

<a href="/puzzles/add"><img src="/img/postpuzzle.png" alt="submit topic" title="submittopic" width="110" height="27"></a>

<?php 
	echo $this->element('topicslist', array('topics'    => $models,
																					'uservotes' => $uservotes,
																					'user_id'   => $user_id)) 
?>
