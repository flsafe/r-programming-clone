<?php
	echo $form->create('Topic', array('controller'=>'topics', 'action'=>'add'));
	echo $form->input('Topic.title');
	echo $form->input('Topic.text');
?>
<img src="<?php echo $html->url(array('controller'=>'topics', 'action'=>'captcha'))?>" />
<?php
	echo $form->input("Topic.captcha", array('label'=>"Type the letters above (Sorry)"));
	echo $form->end("Submit your topic");
?>
