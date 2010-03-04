<?php
	#TODO: I don't think the captcha should have to care about the model or
	# the controller. There has to be a better way to do this.
	#params
	#modelname - The name of the model this form is for
	#formhelper - A reference for the current form helper. Assumes form->create has already been called.
	$controller = Inflector::pluralize(Inflector::underscore(strtolower($modelname)));
?>

<img src="<?php echo $html->url(array('controller'=>"$controller", 'action'=>'captcha'))?>" />
<?php
	echo $formhelper->input("${modelname}.captcha", array('label'=>"Are you a robot?"));
?>