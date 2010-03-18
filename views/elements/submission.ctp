<?php 
		#params
		#submission - A reference to toe submission object that will be displayed
		#uservotes  - The votes asscociated with this user
		#user_id    - Id of the current user
		#showtopic  - Show the title of the topic associated with this submission (optional default false)
		#showeverything - Show all items? false the code preview won't be show. (Optional default true)
	
		$sanitizeUtil->htmlEsc($submission['Submission'], array('text1'));
		$id       = $submission['Submission']['id'];
		$title    = $submission['Submission']['title'];
		$size     = $submission['Submission']['size'];
		$text     = $submission['Submission']['text1'];
		
		if(! isset($showtopic))
			$showtopic = false;
		if(! isset($showeverything))
			$showeverything = true;
		
		$vote     = "none";
		if(isset($uservotes[$id]))
			$vote = $uservotes[$id] ? 'up':'down';
?>
<div class="submission">

	<?php if($showeverything): ?>
		<div class="submissionpreview">
			<?php	echo $syntaxHighlighter->highlight(substr($text, 0, 500), 'java');?>
		</div>
	<?php endif; ?>

	<div class="submissiontitle">
		<?php 
		 	echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));
		
			if($showtopic){
				echo $html->link($submission['Topic']['title'], 
							      array('controller'=> 'topics', 
													'action'    => 'view', 
													'id'        => $submission['Topic']['id']),
							      array('class' => 'submissiontopic'));
				echo "<br/>";
			}
			echo $html->link($title, array('controller'=>'submissions', 'action'=>'view', 'id'=>$id));
		?>
	</div>
	

		<div class="submissionstats">
				<?php 
					if($showeverything)
						echo "Size: $size <br/>" ;
				?>
		</div>


	<?php
		echo $this->element('meta', array('modelname'   => "Submission",
																			'model'       => $submission,
																			'user_id'     => $user_id));
	?>
	
</div>

