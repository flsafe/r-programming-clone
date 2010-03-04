<h1>Vote On Tommorrow's Puzzle!</h1>

<?php 
	echo $javascript->link('jquery/jquery.min', false);
 	echo $javascript->link('jquery/topics', false);
	echo $javascript->link('util', false);
 	echo $javascript->link('jquery/vote', false);
?>

<a href="/topics/add"><img src="/img/submittopic.png" alt="submit topic" title="submittopic"></a>

<div id="topics">
	<?php foreach($topics as $topic):?>

			<?php $points  = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
						$topicid = $topic['Topic']['id'];
						$vote    = 'none';
						if(isset($uservotes[$topicid]))
							$vote = $uservotes[$topicid] ? 'up' : 'down';
						$showedit = false;
						if($loggedin)
							$showedit = true;

						echo $this->element('topic', array('id'       => $topic['Topic']['id'],
																	 					   'title'    => $topic['Topic']['title'],
																							 'points'   => $points,
																							 'username' => $topic['User']['username'],
																							 'vote'     => $vote,
	 																						 'showedit' => $showedit));
			?>
	<?php endforeach;?>
</div>

<?php echo $this->element('pagination'); ?>