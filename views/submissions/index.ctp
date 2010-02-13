<?php echo $html->tag('h1', "This Week's Discussion Topic") ?>

<?php $javascript->link('jquery/jquery.min', false) ?>
<?php $javascript->link('jquery/submissions', false)?>
<?php $javascript->link('jquery/vote', false)?>

<br/>

<?php 
	$id       = $topic['Topic']['id'];
	$title    = $topic['Topic']['title'];
	$text     = $topic['Topic']['text'];
	$points   = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
	$username = $topic['User']['username'];
	
  $sanitizeUtil->htmlEsc($topic['Topic'], array('title','text'));

	echo $this->element('selectedtopic', array('title'=>$title, 'username'=>$username, 'text'=>$text));
	
	echo $html->tag('p',  $html->link("Next Week's Topics", array('controller'=>'topics', 'action'=>'index')). "&nbsp&nbsp".
			 						      $html->link('Submit Solution', array('controller'=>'submissions', 'action'=>'add')));
	
	echo  $html->tag('h3', "This week's solutions:");
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

<?php $this->element('paginiation') ?>