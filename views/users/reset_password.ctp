<?php
	$form->create('User', array('controller'=>'users', 'action'=>'reset_password', 'ticket'=>"$ticket"));
	$form->input('User.password_new', array('label'=>'New Password', 'type'=>'password'));
	$form->input('User.password_confirm', array('lable'=>'Confirm Password', 'type'=>'password'));
	$form->end('Reset My Password');
?>