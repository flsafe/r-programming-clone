<div id="loginpage">

	<div id="register">
		<h2>Register</h2>
		<?php
			echo $form->create("User", array('controller'=>'users', 'action'=>'add'));
			echo $form->label('User.username', 'Username');
			echo $form->input('User.username', array('label'=>false));
			
			echo $form->label('User.email', 'Email');
			echo $form->input('User.email', array('label'=>false));
			
			echo $form->label('User.password_new', 'Password');
			echo $form->input('User.password_new', array('label'=>'Password', 'type'=>'password', 'maxLength'=>'45', 'label'=>false));
			
			echo $form->label('User.password_confirm', 'Confirm Password');
			echo $form->input('User.password_confirm', array('label'=>'Confirm Password', 'type'=>'password', 'maxLength'=>'45', 'label'=>false));
		?>
		<img src="<?php echo $html->url(array('controller'=>'users', 'action'=>'captcha')); ?>"/><br/>
		<?php
			echo $form->label('User.captcha', "Are you a computer program?");
			echo $form->input('User.captcha', array('label'=>false, 'maxLength'=>'45'));
			echo $form->end('Register');
			echo "<br/>";
			echo $html->link('Already A Member?', array('controller'=>'users', 'action'=>'login'));
		?>
	</div>
	
</div>