<?php #Show the user all thier submissions 
	App::import('Core','Inflector');
?>

<h1 id="pagetitleheader">
	My <?php 
					$trans = $translator->toViewName($modelname);
					$plural = Inflector::pluralize($trans);
					echo $plural;
			 ?>
</h1>

<?php 
if($modelname == 'Submission'){
			echo $html->link("Solutions You Liked", array('controller'=>'votes', 'action'=>'liked', 'modelname'=>'Submission'),
			                                        array('class'=>'contentlink')); 
		}
 else{
		echo $html->link('Puzzles You Liked', array('controller'=>'votes', 'action'=>'liked', 'modelname'=>'Topic'),
		                                      array('class'=>'contentlink'));
	}
	if($modelname == 'Submission'){
		echo $this->element('submissionslist', array('submissions' => $models,
																							   'uservotes'   => $uservotes,
																						     'user_id'     => $user_id,
																						      'showtopic'  => true));
	}
	else{
		echo $this->element('topicslist', array('topics'     => $models,
																						'uservotes'  => $uservotes,
																						'user_id'    => $user_id));
	}
?>