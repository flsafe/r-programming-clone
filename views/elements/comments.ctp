<?php 
	#params modelname, model_id, username, user_id

	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
	$doc      = new DOMDocument();
	if($loggedin)
		$commentsBuilder->displayReplys = true;
	$commentsBuilder->buildCommentHiearchy($comments, $doc);
?>

<div id="comments">
	
	<?php 
		if($loggedin == true){
			echo $this->element('submitcommentform', array('modelname'=>$modelname,
																								 'model_id'=>$model_id));
		}
	?>

	<div id="commentslist">
		<?php echo $doc->saveHtml(); ?>
	</div>

</div>	
