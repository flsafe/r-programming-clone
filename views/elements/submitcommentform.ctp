<?php
#params: modelname, model_id
?>

<form id="newcommentform">
	<textarea id="newcommentformtext"></textarea>
	<input id="modelname" value="<?php echo $modelname ?>" type="hidden"/>
	<input id="model_id" value="<?php echo $model_id ?>" type="hidden"/><br/> <!--Get submit button under comment box-->
	<input id="submitcomment" type="submit" value="Comment"/>
	<a class="formathelp" href="/pages/format_help">format help</a>
</form>
