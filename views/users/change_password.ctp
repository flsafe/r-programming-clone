<h2 id="pagetitleheader">Change Password</h2>
<div id="changepassword">
<?php  
	echo $form->create('User', array('controller'=>'users', 'action'=>'change_password'));
	echo $form->input('User.password_current', array('type'=>'password', 'label'=>'Current Password'));
	echo $form->input('User.password_new', array('type'=>'password', 'label'=>'New Password'));
	echo $form->input('User.password_confirm', array('type'=>'password', 'label'=>'Confrim New Password'));
	echo $form->input('User.id', array('type'=>'hidden'));
	echo $form->end('Save');
?>
</div>