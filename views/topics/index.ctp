<h1>Vote On Next Week's Topic</h1>

<p><?php echo "<br/>" . $html->link("Submit Topic", array('controller'=>'topics', 'action'=>'add')); ?></p>
	
<?php foreach($topics as $topic):?>

		<?php $points = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
		
					echo $this->element('topic', array(
																						 'id'       => $topic['Topic']['id'],
																 					   'title'    => $topic['Topic']['title'],
																						 'points'   => $points,
																						 'username' => $topic['User']['username']));
		?>
<?php endforeach;?>
