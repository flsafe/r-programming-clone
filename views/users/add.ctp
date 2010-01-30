<h1>Register</h1>
<?php
	echo $form->create("User", array('controller'=>'users', 'action'=>'add'));
	echo $form->input('User.username');
	echo $form->input('User.email');
	echo $form->input('User.password_new', array('label'=>'Password', 'type'=>'password'));
	echo $form->input('User.password_confirm', array('label'=>'Confirm Password', 'type'=>'password'));
?>
<img src="<?php echo $html->url(array('controller'=>'users', 'action'=>'captcha')); ?>"/>
<?php
	echo $form->input('User.captcha', array('label'=>'Are you a computer program? Type the letters above here.'));
	echo $form->end('Register');
?>
