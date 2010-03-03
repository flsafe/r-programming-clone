<?php
#params: modelname, model_id
?>

<form id="newcommentform">
	<textarea id="newcommentformtext"></textarea>
	<input id="modelname" value="<?php echo $modelname ?>" type="hidden"/>
	<input id="model_id" value="<?php echo $model_id ?>" type="hidden"/>
	<input id="submitcomment" type="submit" value="Submit Comment"/>
</form>
