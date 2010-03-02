<?php #Params:title, id, points, username, vote-("up","down", "none")?>

<div class="topic">
	<?php
		echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));
	?>
	
	<p class="topictitle"> 
		<?php 
			echo $html->link($title, array('controller'=>'topics', 'action'=>'view', $id));
		?>
	</p>

	<?php echo $this->element('meta', array('id'  => $id,
																		 'points'   => $points,
																		 'username' => $username)); 
	?>
</div>
