<?php
	#params
	#action - 'add' or 'edit'
?>

<div id="topicform">
	
<?php
	echo $form->create('Topic', array('controller'=>'topics', 'action'=>$action));
	echo $form->input('Topic.id', array('type'=>'hidden'));
	echo $form->input('Topic.current_topic', array('type'=>'hidden'));
	echo $form->input('Topic.was_chosen', array('type'=>'hidden'));
	echo $form->input('Topic.title', array('label'=>'Title'));
?>

<div class="input">
	<?php echo $form->label('Topic.text', 'Puzzle')?>
</div>

<div class="input">
	<?php echo $form->textArea('Topic.text', array('rows'=>'22')); ?>
</div>

<?php 
	if($action == 'add')
		echo $this->element('captcha', array('modelname'=>'Topic', 'formhelper'=>$form));
	echo $form->end("Submit your topic");	
?>

</dvi>