<h1>Submit Your Code</h1>
<?php
	echo $form->create("Submission", array('controller'=>'submissions', 'action'=>'add_new_submission'));
	echo $form->input('Submission.title');
	echo $form->input('Submission.description1', array('label'=>'File Description'));
	echo $form->label("Submission.text1", "Your Code");
	echo $form->textArea('Submission.text1', array('rows'=>'20', 'title'=>'Paste Your Code'));
	echo $form->end("Submit");
?>