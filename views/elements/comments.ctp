<?php 
	#params modelname, model_id, username, user_id
	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
?>

<?php foreach($comments as $comment): ?>

	<div id="<?php echo "comment{$comment['Comment']['id']}" ?>" class="comment">

	<?php		
		$id = $comment['Comment']['id'];
		$text = <<<EOT
			<script type="text/javascript" charset="utf-8">
			 <![cdata[
				var commentDiv = $("#comment" + comment['Comment']['id']);
				jQuery.data(commentDiv, "meta", {modelname: $modelname, model_id: $model_id, id: $id});
			 ]]>
		  </script>
EOT;
		echo $text;
	?>

	<?php 
		$level  = $comment[0]['depth'];
		$indent = "";
		$sp     = '&nbsp;&nbsp;&nbsp;';
		
		for($i = 0 ; $i < $level ; $i++)
			$indent = $indent.$sp;
			
		if($level == 0)
				echo '<br/>';
				
		$sanitizeUtil->htmlEsc($comment['Comment'], array('text'));
		$sanitizeUtil->htmlEsc($comment['User']['username'], array('text'));
		echo $indent . $comment['User']['username'].'&nbsp;'.$comment['Comment']['text'];
	?>
	
	<a href='#' class="reply" onClick="return false;">reply</a>
	
	</div>
		
<?php endforeach;?>

