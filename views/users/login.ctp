<div id="loginpage">	
	<div id="login">
		<h2>Login</h2>
		<?php
			$session->flash();
			$session->flash('auth');
			echo $form->create("User", array('action'=>'login'));
			
			echo $form->label('User.username', 'Username');
			echo $form->input('User.username', array('label'=>false));
			
			echo $form->label('User.password', 'Password');
			echo $form->input('User.password', array('type'=>'password', 'label'=>false));

			echo $form->end("Login");
		?>
		
		<p id="forgotpassword">
			<?php echo $html->link('Forgot Your Password?', array('controller'=>'users', 'action'=>'forgot_password'));?>
		</p>
		
		<p id ="register">
			<?php echo $html->link('Want To Register?', array('controller'=>'users', 'action'=>'add'));?>
		</p>
	</div>

</div>


