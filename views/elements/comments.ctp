<?php 
	#params modelname, model_id, username, user_id
	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
?>

<?php foreach($comments as $comment): ?>
		
		<?php
			$level = $comment[0]['depth'];
			$indent = "";
			for($i = 0 ; $i < $level ; $i++){
				$indent = $indent . '&nbsp;&nbsp;&nbsp;';
			}
			if($level == 0)
				echo '<br/>';
		?>
			
	<?php 
		$sanitizeUtil->htmlEsc($comment['Comment'], array('text'));
	?>
	
	<div class="comment">
		
		<?php echo $indent . $comment['User']['username'] . ':&nbsp;&nbsp;'. $comment['Comment']['text']  . '&nbsp' .
								$html->link('reply', "/comments/comment/{$modelname}/${model_id}/{$comment['Comment']['id']}/Hello");
		?>

	</div>
		
<?php endforeach;?>

