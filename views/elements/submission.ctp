<?php 
			#id object - id
 			#vote - (up,down,none) 
			#text - display text under title if set
			#size - the size of the solution
			#points - Points to display
			#username - username to dispaly
			#text - code associated with the submition used for preview
			#showedit - if 'true' then the reply link will be displayed, otherwise it won't
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

