<?php
 	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('util', false);
	echo $javascript->link('jquery/comment');
	echo $javascript->link('jquery/submissions', false); #TODO: Need a better way to do this
	echo $javascript->link('jquery/vote', false);
?>

<div id="viewsubmission">
	
	<div id="viewsubmissionhead">	
		
		<div id="viewsubmissionheadtitle">
			<?php
			  $sanitizeUtil->htmlEsc($submission['Submission'], array('title', 'description1', 'id'));
			
				$id       = $submission['Submission']['id'];
				$title    = $submission['Submission']['title'];
				$size     = $submission['Submission']['size'];
				$points   = $submission['Submission']['upvotes'] - $submission['Submission']['downvotes'];
				$username = $submission['User']['username'];
				$text     = $submission['Submission']['text1'];
				$vote     = "none";
				if(isset($uservotes[$id]))
					$vote = $uservotes[$id] ? 'up':'down';

				echo $this->element('submission', array(
																				'id'       => $id,
																				'title'    => $title,
																				'size'     => $size,
																				'points'   => $points,
																				'username' => $username,
																				'text'     => $text,
																				'vote'     => $vote));
			?>
		</div>
		
		<p>
			<?php echo $markdown->parse($submission['Submission']['description1']); ?>
		</p>
		
  </div>

	<div id='viewsubmissioncode'>
		<?php 
				$code = $submission['Submission']['text1']; 
				echo $syntaxHighlighter->highlight($code, 'java');
		?>
	</div>

	<?php
		$sanitizeUtil->htmlEsc($submission['Submission'], array('id'));
		$sanitizeUtil->htmlEsc($submission['Subission']['User'], array('username', 'id'));
	
		echo $this->element('comments', array('modelname'=>'Submission', 
															'model_id' => $submission['Submission']['id'],
															'username' => $submission['User']['username'],
															'user_id'  => $submission['User']['id']));
	?>

</div>