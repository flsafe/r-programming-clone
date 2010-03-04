<?php 
			#params
			#submission - A reference to the submission object that will be displayed
			#uservotes  - The votes asscociated with this user
			#showedit   - Show the edit link? Usally only when the user is logged in
			
			$sanitizeUtil->htmlEsc($submission['Submission'], array('id', 'size', 'upvotes', 'downvotes', 'text1'));
			$id       = $submission['Submission']['id'];
			$title    = $submission['Submission']['title'];
			$size     = $submission['Submission']['size'];
			$points   = $submission['Submission']['upvotes'] - $submission['Submission']['downvotes'];
			$username = $submission['User']['username'];
			$text     = $submission['Submission']['text1'];
			$vote     = "none";
			if(isset($uservotes[$id]))
				$vote = $uservotes[$id] ? 'up':'down';
?>
<div class="submission">

	<div class="submissionpreview">
		<?php echo $syntaxHighlighter->highlight($text, 'java');?>
	</div>

	<div class="submissiontitle">
		<?php 
		 	echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));
			echo $html->link($title, array('controller'=>'submissions', 'action'=>'view', $id));
		?>
	</div>

	<div class="submissionstats">
			<?php 
				echo "Size: $size <br/>" ;
			?>
	</div>

	<?php
		echo $this->element('meta', array('modelname'   => "Submission",
																			'id'          => $id,
																 			'points'      => $points,
																 			'username'    => $username,
																      'showedit'    => $showedit));
	?>
	
</div>

