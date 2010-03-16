<h2 id="pagetitleheader">Edit Comment</h2>
<?php
	echo $form->create('Comment');
	echo $form->input('Comment.id',   array('type'=>'hidden'));
	echo $form->label('Comment.text', 'Edit Text');
	echo $form->input('Comment.text', array('label'=>false, 'rows'=>'14', 'cols'=>'55'));
	echo $form->end('Save');
?>