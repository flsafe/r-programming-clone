<h1>This week's discussion topic</h1>

<br/>

<p> 
	<?php echo $html->link("Next Week's Topics", array('controller'=>'topics', 'action'=>'index')). "&nbsp&nbsp".
					   $html->link('Submit Solution', array('controller'=>'submissions', 'action'=>'add'));
	?> 
</p>

<?php 
	$id       = $topic['Topic']['id'];
	$title    = $topic['Topic']['title'];
	$text     = $topic['Topic']['text'];
	$points   = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
	$username = $topic['User']['username'];
	
	echo $this->element('topic', array(
																'id'       => $id,
																'title'    => $title,
																'text'     => $text,
																'points'   => $points,
																'username' => $username));
?>

<?php foreach($submissions as $submission):?>

	<?php
		$id       = $submission['Submission']['id'];
		$title    = $submission['Submission']['title'];
		$size     = $submission['Submission']['size'];
		$points   = $submission['Submission']['upvotes'] - $submission['Submission']['downvotes'];
		$username = $submission['User']['username'];
	
		echo $this->element('submission', array(
																		'id'       => $id,
																		'title'    => $title,
																		'size'     => $size,
																		'points'   => $points,
																		'username' => $username));
	?>
	
<?php endforeach; ?>