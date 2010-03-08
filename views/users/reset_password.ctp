<h2 id="pagetitleheader">Reset Password</h2>
<?php
if(!isset($ticket))
  $ticket = "";

echo $form->create('User', array('url' => array('controller'=>'users', 'action'=>'reset_password', 'ticket'=>"$ticket")));
echo $form->input('User.password_new', array('label'=>'New Password', 'type'=>'password'));
echo $form->input('User.password_confirm', array('label'=>'Confirm Password', 'type'=>'password'));
echo $form->end('Reset My Password');
?>