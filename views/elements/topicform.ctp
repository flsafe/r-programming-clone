<?php
	#params
	#action - 'add' or 'edit'
?>

<div id="topicform">
	
<?php
	echo $form->create('Topic', array('controller'=>'topics'));
	echo $form->input('Topic.id', array('type'=>'hidden'));
	
	echo $form->input('Topic.title', array('label'=>'Title'));
	echo $form->label('Topic.text', 'Puzzle');
	echo $html->link('(format help)', array('controller'=>'pages', 'action'=>'display', 'format_help'), array('id'=>'formformathelp'));
	echo $form->input('Topic.text', array('div'=>'input','label'=>false, 'rows'=>'22', 'type'=>'textArea'));

?>
<label class='input'>Please Choose What Fits Best</label>
<div id="topicstructs">	
	<?php
	echo $form->input('Algorithm', array('label'        => 'Related Algorithms',
																			 'div'          => 'relatedalgorithms',
																			 'type'         => 'select',
																			 'multiple'     => 'checkbox')); 
															
	
	echo $form->input('DataStructure', array('label'    => 'Related Data Structures',
																					 'div'      => 'relateddatastructs',
																					 'type'     => 'select',
																					 'multiple' => 'checkbox'));
																					
	echo $form->error('Algorithm', 'Please choose at least one algorithm', array('wrap'=>'div', 'id'=>'noalgorithm'));		

	echo $form->error('DataStructure', 'Please choose at least one datastructure', array('wrap'=>'div', 'id'=>'nodatastruct'));
	
  ?>
</div>
	
<?php 
	if($action == 'add')
		echo $this->element('captcha', array('modelname'=>'Topic', 'formhelper'=>$form));
	echo $form->end("Submit your topic");	
?>

</div>