<?php 
	#params modelname, model_id, username, user_id
	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
?>
<div id="comments">
	
	<form id="commentsform">
		<textarea id="commenttext">
		</textarea>
		<input id="modelname" value="<?php echo $modelname ?>" type="hidden"/>
		<input id="model_id" value="<?php echo $model_id ?>" type="hidden"/>
		<input id="submitcomment" type="submit" value="Comment"/>
	</form>

<div id="commentslist">
	
<?php foreach($comments as $comment): ?>

	<div id="<?php echo "comment{$comment['Comment']['id']}" ?>" class="comment">

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
		?>
			
		<?php echo $indent . $comment['User']['username'].':&nbsp;'. $comment['Comment']['text'];?>
		<a href='#' id="<?php echo "reply{$comment['Comment']['id']}" ?>" class="reply" onClick="return false;">reply</a>
	
		<?php		
			$id = $comment['Comment']['id'];
			$text = <<<EOT
				<script type="text/javascript" charset="utf-8">
				 /*<![CDATA[*/
					replyTo = $("#reply{$comment['Comment']['id']}");
					replyTo.data("meta", {modelname: "$modelname", model_id: "$model_id", id: "$id", level:"$level"});
				 /*]]>*/
			  </script>
EOT;
			echo $text;
		?>
	
	</div>
	
<?php endforeach;?>

</div>	
