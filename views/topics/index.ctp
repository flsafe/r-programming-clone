<h2 id="pagetitleheader">Puzzles</h2>

<?php
	#
	# Dispalys a list of topics
	#
  echo $this->element('javascriptjquery');
	echo $this->element('javascriptvote', array('votingFor'=>'topics'));
?>

<a href="/puzzles/add"><img src="/img/postpuzzle.png" alt="submit topic" title="submittopic" width="110" height="27"></a>

<?php 
	echo $this->element('topicslist', array('topics'    => $models,
																					'uservotes' => $uservotes,
																					'user_id'   => $user_id)) 
?>
