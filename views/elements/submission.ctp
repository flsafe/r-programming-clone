<?php # id object - id
 			#vote - (up,down,none) 
			#text - display text under title if set
			#points - Points to display
			#username - username to dispaly
?>

<div id="topics">
	<div class="topic">
		
		<?php 
			echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));
		?>
		
		<p class="title"> 
			<?php 
				echo $html->link($title, array('controller'=>'submissions', 'action'=>'view', $id));
				echo "<br/>";
				if(isset($text))
					echo $text;
			?>
		</p>
	
		<div class="text">
			<p>
				<?php 
					echo "Size: $size <br/>" ;
					echo "Efficiency: <br/>";
					echo "Readability: <br/>";
					echo "Elegance: <br/>";
				?>
			</p>
		</div>
	
		<?php
			echo $this->element('meta', array('id'       => $id,
																	 			'points'   => $points,
																	 			'username' => $username));
		?>
		
	</div>
</div>
