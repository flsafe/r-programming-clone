<h2 id="pagetitleheader">Thanks For Leaving Feedback</h2>

<p class="feedbackmessage">
<span id='fluster'>Did my codes frustrate you?</span>
</p>

<p class="feedbackmessage">
Let me know... <span id="fluster">I'll make it right!</span>
</p> 

<?php

		echo $form->create('Contact');
		echo $form->label('Contact.name','Your Name');
		echo $form->input('Contact.name', array('label'=>false));
		
		echo $form->label('Contact.email', 'Your Email');
		echo $form->input('Contact.email', array('label'=>false));
		
		echo $form->label('Contact.feedback', 'Your Feedback');
		echo $form->input('Contact.feedback', array('label'=>false, 'cols'=>'60', 'rows'=>'10'));
		
		echo $form->end('Send');
?>