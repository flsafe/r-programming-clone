<?php #Params:
	    #title - The title of the topic
			#id - The id of the topic 
			#points - How many points does this have?
			#username - The user who submitted this topic 
			#vote-("up","down", "none")
			#showedit - Show the edit link? ?>

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
																		 'modelname'=> "Topic",
																		 'points'   => $points,
																		 'username' => $username,
																		 'showedit' => $showedit)); 
	?>
</div>
