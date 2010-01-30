<h1>Edit Your Info</h1>
<?php
echo $form->create('User', array('controller'=>'users', 'action'=>'edit'));
echo $form->input('User.email', array('label'=>'Current Email'));
echo $form->input('User.password_current', array('type'=>'password', 'label'=>'Current Password'));
echo $form->input('User.password_new', array('type'=>'password', 'label'=>'New Password'));
echo $form->input('User.password_confirm', array('type'=>'password', 'label'=>'Confrim New Password'));
echo $form->input('User.id', array('type'=>'hidden'));
echo $form->end('Save');
?>
