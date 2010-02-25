<div id="submitsolution">
	
	<h1>Submit Your Code</h1>
	<?php
		echo $form->create("Submission", array('controller'=>'submissions', 'action'=>'add'));
		echo $form->input('Submission.title');
		echo $form->input('Submission.description1', array('label'=>'File Description'));
	?>
	
	<div class="input">
		<?php echo $form->label("Submission.text1", "Paste Your Code Here"); ?>
	</div>
	<div class="input">
		<?php	echo $form->textArea('Submission.text1', array('rows'=>'22'));?>
	</div>

	<?php
		echo $form->error("Submission.text1");
	?>

	<div>
	<img src="<?php echo $html->url(array('controller'=>'submissions', 'action'=>'captcha'));?>"/>
	</div>

	<?php	
		echo $form->input("Submission.captcha", array('label'=>"Are you a robot?"));
		echo $form->end("Submit"); 
	?>
	
</div>
