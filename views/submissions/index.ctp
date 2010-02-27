<?php 
	echo $javascript->link('jquery/jquery.min', false);
	echo  $javascript->link('jquery/submissions', false); #TODO: Kind of a hack. What's the better way?
	echo $javascript->link('util', false);
	echo  $javascript->link('jquery/vote', false);
?>

<?php 
	$id       = $topic['Topic']['id'];
	$title    = $topic['Topic']['title'];
	$text     = $topic['Topic']['text'];
	$points   = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
	$username = $topic['User']['username'];
	
  $sanitizeUtil->htmlEsc($topic['Topic'], array('title','text'));

  echo $this->element('selectedtopic', array('title'=>$title, 'username'=>$username, 'text'=>$markdown->parse($text)));
?>

<div id="submissionmenu">

	<a href="/submissions/add" title="Submit Solution">
		<img	src="/img/submitbutton.png" alt="submit your solution"/>
	</a>

	<a href="/submissions/add" title="Submit Solution">
		<img	src="/img/submitbutton.png" alt="submit your solution"/>
	</a>

	<a href="/submissions/add" title="Submit Solution">
		<img	src="/img/submitbutton.png" alt="submit your solution"/>
	</a>
	
</div>

<div id="submissions">
<?php foreach($submissions as $submission):?>

	<?php
		$sanitizeUtil->htmlEsc($submission['Submission'], array('id','title', 'size', 'upvotes', 'downvotes', 'text1'));
		$id       = $submission['Submission']['id'];
		$title    = $submission['Submission']['title'];
		$size     = $submission['Submission']['size'];
		$points   = $submission['Submission']['upvotes'] - $submission['Submission']['downvotes'];
		$username = $submission['User']['username'];
		$text     = $submission['Submission']['text1'];
		$vote     = "none";
		if(isset($uservotes[$id]))
			$vote = $uservotes[$id] ? 'up':'down';
	
		echo $this->element('submission', array(
																		'id'       => $id,
																		'title'    => $title,
																		'size'     => $size,
																		'points'   => $points,
																		'username' => $username,
																		'text'     => $text,
																		'vote'     => $vote));
	?>
	
<?php endforeach; ?>
</div>

<?php $this->element('paginiation') ?>