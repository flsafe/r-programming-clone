<?php
	#
	#Displays a the topic the user selected with the user submissions under it.
	#
	echo $this->element('javascriptjquery');
	echo $this->element('javascriptvote', array('votingFor'=>'submissions'));
?>

<?php 
  echo $this->element('selectedtopic', $topic);
?>

<?php
	echo $html->link($html->image('/img/postsolution.png', array('alt'=>'Submit my solution to the puzzle',
																												'title'=>'Submit my solution to the puzzle above',
																												'width'=>'110',
																												'height'=>'27')),
							array('controller'=>'topics', 'action'=>'add_submission', 'id'=>$topic['Topic']['id']),
							array(),
							false,
							false);

	echo $this->element('submissionslist', array('submissions'=> $models, 
																							 'uservotes'  => $uservotes,
																							 'user_id'    => $user_id));
?>
