<?php 
	#params modelname, model_id, username, user_id

	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
	$doc      = new DOMDocument();
	$commentsBuilder->buildCommentHiearchy($comments, $doc);
?>

<div id="comments">
	
	<form id="newcommentform">
		<textarea id="newcommentformtext"></textarea>
		<input id="modelname" value="<?php echo $modelname ?>" type="hidden"/>
		<input id="model_id" value="<?php echo $model_id ?>" type="hidden"/>
		<input id="submitcomment" type="submit" value="Comment"/>
	</form>

	<div id="commentslist">
		<?php echo $doc->saveHtml(); ?>
	</div>

</div>	
