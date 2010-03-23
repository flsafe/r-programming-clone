<?php
	echo $javascript->link('jquery/jquery.min');
	echo $javascript->link('jquery/search');
?>

<div id="sidebar">
	<p>
		CodeKettl is the funnest way to practice your programming skills and learn from other programmers.
	</p>
	<p>
		Browse tough programming puzzles, share your solutions, get feedback, get better, learn together!
	</p>
		
	<?php
		echo $this->element('search');
	?>
		
		<div id="add">
			<p>Your advertisement or job listing could be here! Details coming soon.</p>
			<img id="addimg" src="/img/tps.png" height="200">
		</div>
		
</div>