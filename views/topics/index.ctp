<h1>Vote On Tommorrow's Puzzle!</h1>

<?php $javascript->link('jquery/jquery.min', false) ?>
<?php $javascript->link('json2min.js') ?>
<?php $javascript->link('jquery/topics', false)?>
<?php $javascript->link('jquery/vote', false)?>

<p><?php echo $html->link("Submit Topic", array('controller'=>'topics', 'action'=>'add')); ?></p>

<div id="topics">
	<?php foreach($topics as $topic):?>

			<?php $points  = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
						$topicid = $topic['Topic']['id'];
						$vote    = 'none';
						if(isset($uservotes[$topicid]))
							$vote = $uservotes[$topicid] ? 'up' : 'down';

						echo $this->element('topic', array('id'       => $topic['Topic']['id'],
																	 					   'title'    => $topic['Topic']['title'],
																							 'points'   => $points,
																							 'username' => $topic['User']['username'],
																							 'vote'     => $vote));
			?>
	<?php endforeach;?>
</div>

<?php echo $this->element('pagination'); ?>