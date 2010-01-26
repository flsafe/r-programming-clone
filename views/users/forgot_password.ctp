<?php
	echo $form->create('User', array('controller'=>'users', 'action'=>'forgot_password'));
	echo $form->input("User.username");
	echo $form->input("User.email");
	echo $form->end("Reset my password");
?>