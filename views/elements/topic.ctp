<?php #Params:
			#topic          - A reference to the topic that will be displayed
			#uservotes      - A reference to the array of user votes
			#user_id        - The currently logged in user id
			
		 	$id       = $topic['Topic']['id'];
			$title    = $topic['Topic']['title'];

			$vote     = 'none';
			if(isset($uservotes[$id]))
				$vote = $uservotes[$id] ? 'up' : 'down';
				
			if(! isset($showeverything))
				$showeverything = true;
?>

<div class="topic">
	 <?php
	  	echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));
	 ?>
	
	<p class="topictitle"> 
		<?php 
			echo $html->link($title, array('controller'=>'submissions', 'action'=>'index', $id));
		?>
	</p>

	<?php
			echo $this->element('meta', array('model' 					=> $topic,
																		 	  'modelname'       => 'Topic',
																				'user_id'         => $user_id));

	?>
</div>
