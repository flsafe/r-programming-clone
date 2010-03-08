<?php
	#params - none
?>
<div id="contentmenu">

	<div id="contentlinks">
	<?php
		echo $html->link("Today's Puzzle", array('controller'=>'submissions', 'action'=>'index'),
						                           array('class'=>'contentmenulink'));
						
		echo $html->link("Vote On Puzzles", array('controller'=>'topics', 'action'=>'index'),
						                            array('class'=>'contentmenulink'));
		
		echo $html->link("My Solutions", array('controller'=>'users', 'action'=>'review', 'modelname'=>'Submission'),
			                               array('class'=>'contentmenulink'));
			
		echo $html->link("My Puzzles", array('controller'=>'users', 'action'=>'review', 'modelname'=>'Topic'),
		                               array('class'=>'contentmenulink'));
	?>
	</div>
	
</div>