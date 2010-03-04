<?php #Params:
			#topic     - A reference to the topic that will be displayed
			#uservotes - A reference to the array of user votes
			#showedit - Show the edit link? 
			
		 	$id       = $topic['Topic']['id'];
			$title    = $topic['Topic']['title'];
			$username = $topic['User']['username'];
			$points   = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
			$vote     = 'none';
			if(isset($uservotes[$id]))
				$vote = $uservotes[$id] ? 'up' : 'down';
?>

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
