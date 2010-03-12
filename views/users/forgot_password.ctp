<h2 id="pagetitleheader">Forgot Password</h2>

<?php
	echo $form->create('User', array('controller'=>'users', 'action'=>'forgot_password'));
	
	echo $form->label('User.username', "User Name");
	echo $form->input('User.username', array('label'=>false));
	
	echo $form->label('User.email', "Email");
	echo $form->input("User.email", array('label'=>false));
	
	echo $form->end("Reset my password");
?>