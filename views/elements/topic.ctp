<?php #Params:
			#topic          - A reference to the topic that will be displayed
			#uservotes      - A reference to the array of user votes
			#user_id        - The current user id
			#showeverything - Show only the title if false. (Optional default is true) 
			
		 	$id       = $topic['Topic']['id'];
			$title    = $topic['Topic']['title'];
			$username = $topic['User']['username'];
			$points   = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
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
			echo $html->link($title, array('controller'=>'topics', 'action'=>'view', 'id'=>$id));
		?>
	</p>

	<?php
		if($showeverything){
			$showedit = $user_id == $topic['User']['id'] ? true : false;
			echo $this->element('meta', array('id'  => $id,
																		 'modelname'=> "Topic",
																		 'points'   => $points,
																		 'username' => $username,
																		 'showedit' => $showedit)); 
	 }
	?>
</div>
