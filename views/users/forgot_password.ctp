<h2 id="pagetitleheader">Forgot Password</h2>

<?php
	echo $form->create('User', array('controller'=>'users', 'action'=>'forgot_password'));
	echo $form->input("User.username");
	echo $form->input("User.email");
	echo $form->end("Reset my password");
?>