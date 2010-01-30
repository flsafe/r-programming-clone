<h1>Submit Your Code</h1>
<?php
	echo $form->create("Submission", array('controller'=>'submissions', 'action'=>'add'));
	echo $form->input('Submission.title');
	echo $form->input('Submission.description1', array('label'=>'File Description'));
	echo $form->label("Submission.text1", "Paste Your Code Here");
	echo $form->textArea('Submission.text1', array('rows'=>'22', 'title'=>'Paste Your Code'));
	echo $form->error("Submission.text1");
?>
<img src="<?php echo $html->url(array('controller'=>'submissions', 'action'=>'captcha'));?>"/>
<?php	
	echo $form->input("Submission.captcha", array('label'=>"Are you a robot? Type the text above."));
	echo $form->end("Submit"); 
?>

