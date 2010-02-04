<h1>Vote On Next Week's Topic</h1>

<p><?php echo "<br/>" . $html->link("Submit Topic", array('controller'=>'topics', 'action'=>'add')); ?></p>

<?php $javascript->link('jquery/jquery.min', false) ?>
<?php $javascript->link('jquery/topics_index', false)?>

<?php foreach($topics as $topic):?>

		<?php $points = $topic['Topic']['upvotes'] - $topic['Topic']['downvotes'];
		
					echo $this->element('topic', array('id'       => $topic['Topic']['id'],
																 					   'title'    => $topic['Topic']['title'],
																						 'points'   => $points,
																						 'username' => $topic['User']['username']));
		?>
<?php endforeach;?>

<div class="pagination">
	<p>
<?php  
	echo $paginator->prev('« Previous ', null, null);
 	echo $paginator->next(' Next »', null, null); 
?>
</p>
</div>