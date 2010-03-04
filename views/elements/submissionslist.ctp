<?php
	#params
	#submissions - An array of submissions to display in the format returned by model find methods
	#uservotes   - (optional, default shows no voting data)
	#								The votes associated with each submission. Used to display the right up/down arrows.
	#loggedin    - (optional, default is logged out)
	#					     'true' if the current user is logged in, false by default. Used for things like 
	#  							displaying the 'reply' link.
?>
<div id="submissions">
<?php foreach($submissions as $submission):?>

	<?php
		$sanitizeUtil->htmlEsc($submission['Submission'], array('id', 'size', 'upvotes', 'downvotes', 'text1'));
		$id       = $submission['Submission']['id'];
		$title    = $submission['Submission']['title'];
		$size     = $submission['Submission']['size'];
		$points   = $submission['Submission']['upvotes'] - $submission['Submission']['downvotes'];
		$username = $submission['User']['username'];
		$text     = $submission['Submission']['text1'];
		$vote     = "none";
		if(isset($uservotes) && isset($uservotes[$id]))
			$vote = $uservotes[$id] ? 'up':'down';
		$showedit = false;
		if(isset($loggedin) && $loggedin == true)
			$showedit = $loggedin;
		
		echo $this->element('submission', array(
																		'id'       => $id,
																		'title'    => $title,
																		'size'     => $size,
																		'points'   => $points,
																		'username' => $username,
																		'text'     => $text,
																		'vote'     => $vote,
																		'showedit'=> $showedit));
	?>
	
<?php endforeach; ?>
</div>

<?php $this->element('paginiation') ?>