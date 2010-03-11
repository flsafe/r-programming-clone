<?php
	#TODO: I don't think the captcha should have to care about the model or
	# the controller. There has to be a better way to do this.
	#params
	#modelname - The name of the model this form is for
	#formhelper - A reference for the current form helper. Assumes form->create has already been called.
	$controller = Inflector::pluralize(Inflector::underscore(strtolower($modelname)));
?>


<img src="<?php echo $html->url(array('controller'=>"$controller", 'action'=>'captcha'))?>" />
<table>
	
	<tr>
		<td class="input">
		<?php echo $formhelper->label("${modelname}.captcha", "Are you a robot?") ?>
		</td>
	</tr>

	<tr>
		<td>
		<?php
			echo $formhelper->input("${modelname}.captcha", array('label'=>false, 'maxLength'=>'45', 'size'=>'14'));
		?>
		</td>
	</tr>

</table>
