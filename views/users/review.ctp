<?php #Show the user all thier submissions 
	App::import('Core','Inflector');
?>

<h1 id="pagetitleheader">
	My <?php 
					$trans = $translator->toViewName($modelname);
					$plural = Inflector::pluralize($trans);
					echo $plural;
			 ?>
</h1>

<?php if($modelname == 'Submission'): ?>
	<a href="/votes/liked/Submission" title="See the solutions I liked">
		<img	src="/img/likedsolutions.png" alt="See the solutions I liked"/>
	</a>
	
<?php else: ?>
	<a href="/votes/liked/Topic" title="See the puzzles I liked">
		<img	src="/img/likedpuzzles.png" alt="See the puzzles I liked"/>
	</a>
<?php endif; ?>

<?php
	if($modelname == 'Submission'){
		echo $this->element('submissionslist', array('submissions' => $models,
																							   'uservotes'   => $uservotes,
																						     'user_id'     => $user_id,
																						      'showtopic'  => true));
	}
	else{
		echo $this->element('topicslist', array('topics'     => $models,
																						'uservotes'  => $uservotes,
																						'user_id'    => $user_id));
	}
?>