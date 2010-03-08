<h2 id="pagetitleheader">Edit Info</h2>

<div id="editinfo">
	<?php
		echo $form->create('User', array('controller'=>'users', 'action'=>'edit'));
		echo $form->input('User.email', array('label'=>'Current Email'));
		echo $form->input('User.id', array('type'=>'hidden'));
		echo $form->end('Save');
	?>
	
	<p>
		Change your password? Click <a href="<?php echo "/users/change_password/$user_id"; ?>">here.</a>
	<p>
</div>