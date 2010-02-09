<h1>This week's discussion topic</h1>

<?php $javascript->link('jquery/jquery.min', false) ?>
<?php $javascript->link('jquery/submissions', false)?>
<?php $javascript->link('jquery/vote', false)?>

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
	
  $sanitizeutil->htmlEsc($topic['Topic'],array('title','text'));

	echo $this->element('topic', array(
																'id'       => '0',
																'title'    => $title,
																'text'     => $text,
																'points'   => $points,
																'username' => $username,
																'vote'     => 'none'));
?>

<?php foreach($submissions as $submission):?>

	<?php
		$id       = $submission['Submission']['id'];
		$title    = $submission['Submission']['title'];
		$size     = $submission['Submission']['size'];
		$points   = $submission['Submission']['upvotes'] - $submission['Submission']['downvotes'];
		$username = $submission['User']['username'];
		$vote     = "none";
		if(isset($uservotes[$id]))
			$vote = $uservotes[$id] ? 'up':'down';
	
		echo $this->element('submission', array(
																		'id'       => $id,
																		'title'    => $title,
																		'size'     => $size,
																		'points'   => $points,
																		'username' => $username,
																		'vote'     => $vote));
	?>
	
<?php endforeach; ?>