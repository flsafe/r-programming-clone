<div>
	<div id="register">
		
		<h2>Not A Member? Registering Is Fast And Easy!</h2>
		<?php
			echo $form->create("User", array('controller'=>'users', 'action'=>'add'));
			echo $form->input('User.username');
			echo $form->input('User.email');
			echo $form->input('User.password_new', array('label'=>'Password', 'type'=>'password'));
			echo $form->input('User.password_confirm', array('label'=>'Confirm Password', 'type'=>'password'));
		?>
		<img src="<?php echo $html->url(array('controller'=>'users', 'action'=>'captcha')); ?>"/>
		<?php
			echo $form->input('User.captcha', array('label'=>'Are you a computer program?'));
			echo $form->end('Register');
		?>
	</div>

	<div id="login">
		<h2>Already A member? Login Here</h2>
		<?php
			$session->flash();
			$session->flash('auth');
			echo $form->create("User", array('action'=>'login'));
			echo $form->input('User.username');
			echo $form->input('User.password', array('type'=>'password'));
			echo $form->end("Login");
		?>
		<p>Forgot your password? Get it <a href="forgot_password">here</a>.</p>
	</div>
</div>



