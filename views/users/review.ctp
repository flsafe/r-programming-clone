<?php 
	#This view shows the models owned by a user

	App::import('Core','Inflector');
	
	echo $this->element('javascriptjquery');
	echo $this->element('javascriptvote', array('votingFor'=>'submissions'));
?>

<h2 id="pagetitleheader">
	My <?php 
					$trans = $translator->toViewName($modelname);
					$plural = Inflector::pluralize($trans);
					echo $plural;
			 ?>
</h2>

<?php 
	#Todo, this seems to be the job of the lineItem component. Figure out a way to display
	#comments, and topics in one place
	
	if($modelname == 'Submission'){
			echo $this->element('javascriptvote', array('votingFor'=>'submissions'));
			
			echo $html->link('Show Liked', array('controller'=>'votes', 
																					 'action'    =>'liked', 
																					 'modelname' =>'Submission'),
				                             array('class'     =>'contentlink')); 
			
			echo $this->element('submissionslist', array('submissions'   => $models,
																									   'uservotes'   => $uservotes,
																								     'user_id'     => $user_id,
																								     'showtopic'   => true));			
	}
	 else{
			echo $this->element('javascriptvote', array('votingFor'=>'topics'));
	
			echo $html->link('Show Liked', array('controller'=>'votes', 
			                                     'action'    =>'liked', 
			                                     'modelname' =>'Topic'),
			                               array('class'     =>'contentlink'));
		
			echo $this->element('topicslist', array('topics'     => $models,
																		          'uservotes'  => $uservotes,
																		          'user_id'    => $user_id));
	}
?>