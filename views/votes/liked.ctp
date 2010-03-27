
<?php 
	#Shows all the models the user upvoted
	
	App::import('Core', 'Inflector');
	$this->element('javascriptjquery');

	$modelnameplural = Inflector::pluralize($translator->toViewName($modelname));
	$listtype        = $modelnameplural . 'list';
	
	if($liked)
		echo $html->tag('h2', "${modelnameplural} You Liked", array('id'=>'pagetitleheader'));
	else
		echo $html->tag('h2', "${modelnameplural} You Didn't Like", array('id'=>'pagetitleheader'));
	
	if($modelname == "Submission"){
		echo $this->element('javascriptvote', array('votingFor'=>'submissions'));
		echo $this->element('submissionslist', array('submissions' => $models,
																							   'uservotes'   => $uservotes,
																							   'user_id'     => $user_id,
																							   'showtopic'   => true));
	}
	else{
		echo $this->element('javascriptvote', array('votingFor'=>'topics'));
		echo $this->element('topicslist', array('topics'       => $models,
																						'uservotes'    => $uservotes,
																						'user_id'      => $user_id));
	}
?>