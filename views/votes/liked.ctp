
<?php #Show the user all the submissions they upvoted
	App::import('Core', 'Inflector');

	$modelnameplural = Inflector::pluralize($translator->toViewName($modelname));
	$listtype        = $modelnameplural . 'list';
	
	if($liked)
		echo $html->tag('h1', "${modelnameplural} You Liked", array('id'=>'pagetitleheader'));
	else
		echo $html->tag('h1', "${modelnameplural} You Didn't Like", array('id'=>'pagetitleheader'));
	
	if($modelname == "Submission"){
		echo $this->element('submissionslist', array('submissions' => $models,
																							   'uservotes'   => $uservotes,
																							   'user_id'    => $user_id));
	}
	else{
		echo $this->element('topicslist', array('topics'    => $models,
																						'uservotes' => $uservotes,
																						'user_id'  => $user_id));
	}
?>