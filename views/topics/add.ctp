<?php
	echo $form->create('Topic', array('controller'=>'topics', 'action'=>'add'));
	echo $form->input('Topic.title', array('label'=>'Title'));
?>

<div class="input">
	<?php echo $form->label('Topic.text', 'Puzzle')?>
</div>
<div class="input">
	<?php echo $form->textArea('Topic.text', array('rows'=>'22')); ?>
</div>
	<?php echo $form->end("Submit your topic");	?>





