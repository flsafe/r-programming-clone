<?php
	$session->flash();
	$session->flash('auth');
	echo $form->create("User", array('action'=>'login'));
	echo $form->input('User.username');
	echo $form->input('User.password', array('type'=>'password'));
	echo $form->end("Login");
?>

<p>Not registered? Register <a href="add">here</a>.<br/>
	 Forgot your password? Get it <a href="forgot_password">here</a>.<p>