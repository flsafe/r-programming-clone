
<?php #Show the user all the submissions they upvoted
	App::import('Core', 'Inflector');
	
	#TODO: Temp hack until I refactor the model names
	$translate = array('Submission'=>'Solution', 'Topic'=>'Puzzle');
	
	$modelnameplural = Inflector::pluralize($translate[$modelname]);
	$listtype        = $modelnameplural . 'list';
	
	if($liked)
		echo $html->tag('h1', "${modelnameplural} You Liked");
	else
		echo $html->tag('h1', "${modelnameplural} You Didn't Like");
	
	if($modelname == "Submission"){
		echo $this->element('submissionslist', array('submissions' => $models,
																							   'uservotes'   => $uservotes,
																							   'loggedin'    => true));
	}
	else{
		echo $this->element('topicslist', array('topics'    => $models,
																						'uservotes' => $uservotes,
																						'loggedin'  => true));
	}
?>