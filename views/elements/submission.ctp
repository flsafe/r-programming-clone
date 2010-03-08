<?php 
			#params
			#submission - A reference to toe submission object that will be displayed
			#uservotes  - The votes asscociated with this user
			#user_id    - Id of the current user
			#showtopic  - Show the title of the topic associated with this submission (optional default false)
			#showeveything  - Show the title only (optional default is true)
			
			if(! isset($showtopic))
				$showtopic = false;
			if(! isset($showeverything))
				$showeverything = true;
			
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

	<?php  if($showeverything):?>
		<div class="submissionpreview">
			<?php echo $syntaxHighlighter->highlight($text, 'java');?>
		</div>
	<?php endif; ?>

	<div class="submissiontitle">
		<?php 
		 	echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));
		
			if($showtopic){
				echo $html->link($submission['Topic']['title'], 
							      array('controller'=>'topics', 'action'=>'view', 'id'=>$submission['Topic']['id']),
							      array('class'=>'submissiontopic'));
				echo "<br/>";
			}

			echo $html->link($title, array('controller'=>'submissions', 'action'=>'view', 'id'=>$id));
		?>
	</div>

	<?php if($showeverything): ?>
		<div class="submissionstats">
				<?php 
					echo "Size: $size <br/>" ;
				?>
		</div>

		<?php
			$showedit = $user_id == $submission['Submission']['user_id'] ? true : false;
			echo $this->element('meta', array('modelname'   => "Submission",
																				'id'          => $id,
																	 			'points'      => $points,
																	 			'username'    => $username,
																	      'showedit'    => $showedit));
		?>
	<?php endif; ?>
	
</div>

