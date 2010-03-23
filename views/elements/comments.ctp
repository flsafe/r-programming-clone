<?php #params 
			#model     - A reference to the model to display comments for
			#modelname - The name of the model
      #user_id   - The id of the logged in user
			
			$model_id = $model[$modelname]['id'];
?>

<?php
	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
	$doc      = new DOMDocument();
	
	if(!empty($sessionUser))
		$commentsBuilder->displayReplys = true;
	$commentsBuilder->buildCommentHiearchy($user_id, $comments, $doc, $markdown, $htmlPurifier);
?>

<div id="comments">
	
	<?php 
		if(empty($sessionUser)){
			echo $this->element('submitcommentform', array('modelname' => $modelname,
																								     'model_id'  => $model_id));
		}
	?>

	<div id="commentslist">
		<?php echo $doc->saveHtml(); ?>
	</div>

</div>	
