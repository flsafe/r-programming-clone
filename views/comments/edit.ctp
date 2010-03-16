<?php
	echo $form->create('Comment');
	echo $form->input('Comment.id',   array('type'=>'hidden'));
	echo $form->label('Comment.text', 'Edit Text');
	echo $form->input('Comment.text', array('label'=>false, 'rows'=>'22'));
	echo $form->end('Save');
?>