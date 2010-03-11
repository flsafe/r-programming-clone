<?php
	#params
	#action - 'add' or 'edit'
?>

<div id="topicform">
	
<?php
	echo $form->create('Topic', array('controller'=>'topics'));
	echo $form->input('Topic.id', array('type'=>'hidden'));
	echo $form->input('Topic.title', array('label'=>'Title'));
	echo $form->input('Topic.text', array('div'=>'input','label'=>"Puzzle", 'rows'=>'22', 'type'=>'textArea'));
?>

<div id="topicstructs">	
	<?php
	echo $form->input('Algorithm', array('label'        => 'Related Algorithms',
																			 'div'          => 'relatedalgorithms',
																			 'type'         => 'select',
																			 'multiple'     => 'checkbox'/*
																			 'options'      =>  $algorithms)*/)); 
	
	echo $form->input('DataStructure', array('label'    => 'Related Data Structures',
																					 'div'      => 'relateddatastructs',
																					 'type'     => 'select',
																					 'multiple' => 'checkbox'/*,
																					 'options'  => $datastructures)*/));
																					
	echo $form->error('Algorithm', 'Please choose at least one algorithm', array('wrap'=>'p'));
	echo $form->error('DataStructure', 'Please choose at least one datastructure', array('wrap'=>'p'));
  ?>
</div>
	
<?php 
	if($action == 'add')
		echo $this->element('captcha', array('modelname'=>'Topic', 'formhelper'=>$form));
	echo $form->end("Submit your topic");	
?>

</div>