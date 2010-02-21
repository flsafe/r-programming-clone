<?php # id object - id
 			#vote - (up,down,none) 
			#text - display text under title if set
			#size - the size of the solution
			#points - Points to display
			#username - username to dispaly
			#text - code associated with the submition used for preview
?>
<div class="submission">

	<div class="submissioncode">
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
				echo "Elegance: <br/>";
				echo "Efficiency: <br/>";
			?>
	</div>

	<?php
		echo $this->element('meta', array('id'       => $id,
																 			'points'   => $points,
																 			'username' => $username));
	?>
</div>

