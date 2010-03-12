<h2 id="pagetitleheader">Change Password</h2>

<div id="changepassword">
<?php  
	echo $form->create('User', array('controller'=>'users', 'action'=>'change_password'));
	
	echo$form->label('User.password_current', 'Current Password');
	echo $form->input('User.password_current', array('type'=>'password', 'label'=>false));
	
	echo $form->label('User.password_new', 'New Password');
	echo $form->input('User.password_new', array('type'=>'password', 'label'=>false));
	
	echo $form->label('User.password_confirm', 'Confirm Password');
	echo $form->input('User.password_confirm', array('type'=>'password', 'label'=>false));
	
	echo $form->end('Save');
?>
</div>