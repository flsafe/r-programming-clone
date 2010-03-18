<h2 id="pagetitleheader">Reset Password</h2>
<?php
	if(!isset($ticket))
	  $ticket = "";

	echo $form->create('User', array('url' => array('controller'=>'users', 'action'=>'reset_password', 'ticket'=>"$ticket")));

	echo $form->label('User.password_new', "New Password");
	echo $form->input('User.password_new', array('label'=>false, 'type'=>'password'));

	echo $form->label('User.password_confirm', "Confirm Passowrd");
	echo $form->input('User.password_confirm', array('label'=>false, 'type'=>'password'));

	echo $form->end('Reset My Password');
?>