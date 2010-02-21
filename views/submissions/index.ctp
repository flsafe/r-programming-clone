
<?php $javascript->link('jquery/jquery.min', false) ?>
<?php $javascript->link('jquery/submissions', false) #TODO: You can use jquery data to do this?> 
<?php $javascript->link('jquery/vote', false)?>

<?php 
	$id       = $topic['Topic']['id'];
	$title    = $topic['Topic']['title'];
	$text     = $topic['Topic']['text'];
	$points   = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
	$username = $topic['User']['username'];
	
  $sanitizeUtil->htmlEsc($topic['Topic'], array('title','text'));

  echo $this->element('selectedtopic', array('title'=>$title, 'username'=>$username, 'text'=>$markdown->parse($text)));
?>

<div id="submitsolution">
	<a href="/submissions/add" title="Submit Solution">
		<img	src="/img/submitbutton.gif" alt="submit your solution" height="50" width="200"/>
	</a>
</div>

<div id="submissions">
<?php foreach($submissions as $submission):?>

	<?php
		$sanitizeUtil->htmlEsc($submission['Submission'], array('id','title', 'size', 'upvotes', 'downvotes'));
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
</div>

<?php $this->element('paginiation') ?>