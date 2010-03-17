<?php
	echo $html->tag('h1', 'Search Results', array('id'=>'#pagetitleheader'));
	
	if($modelname == "Submission"){
		echo $this->element('submissionslist', array('submissions'=> $results,
																						     'user_id'    => $user_id,
																						     'uservotes'  => $uservotes));
		
	}
	elseif($modelname == "Topic"){
		echo $this->element('topicslist', array('topics'=> $results,
																			     'user_id'=> $user_id,
																			   'uservotes'=> $uservotes));
	}
?>