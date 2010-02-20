<?php # id object - id
 			#vote - (up,down,none) 
			#text - display text under title if set
			#size - the size of the solution
			#points - Points to display
			#username - username to dispaly
?>

<div id="submissions">
	<div class="submission">

		<?php echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));?>
		
		<div class="submissiontitle">
			<?php 
				echo $html->link($title, array('controller'=>'submissions', 'action'=>'view', $id));
				if(isset($text))
					echo $text;
			?>
		</div>
	
		<div class="submissionstats">
				<?php 
					echo "Size: $size <br/>" ;
					echo "Efficiency: <br/>";
					echo "Readability: <br/>";
					echo "Elegance: <br/>";
				?>
		</div>
	
		<?php
			echo $this->element('meta', array('id'       => $id,
																	 			'points'   => $points,
																	 			'username' => $username));
		?>
	</div>
</div>
