
<h1>Register</h1>
<?php
	echo $form->create("User", array('controller'=>'users', 'action'=>'register_new_user'));
	echo $form->input('User.username');
	echo $form->input('User.email');
	echo $form->input('User.password_new', array('label'=>'Password', 'type'=>'password'));
	echo $form->input('User.password_confirm', array('label'=>'Confirm Password', 'type'=>'password'));
	echo $form->end('Register');
?>	
