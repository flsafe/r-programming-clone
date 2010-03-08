<?php
	#params - none
	#selected - (today, puzzles, mysolutions, mypuzzles)
?>
<div id="contentmenu">

	<div id="contentlinks">
	<?php
	  $class            = array('today'=>'', 'puzzles'=>'', 'mysolutions'=>'', 'mypuzzles'=>'');
		$class[$selected] = 'selected';
													
		echo $html->link("Today's Puzzle",  array('controller'=>'submissions', 'action'=>'index'),
						                            array('class'=>"contentmenulink {$class['today']}"));
						
		echo $html->link("Vote On Puzzles", array('controller'=>'topics', 'action'=>'index'),
						                            array('class'=>"contentmenulink {$class['puzzles']}"));
		
		echo $html->link("My Solutions",    array('controller'=>'users', 'action'=>'review', 'modelname'=>'Submission'),
			                                  array('class'=>"contentmenulink {$class['mysolutions']}"));
			
		echo $html->link("My Puzzles",      array('controller'=>'users', 'action'=>'review', 'modelname'=>'Topic'),
		                               			array('class'=>"contentmenulink {$class['mypuzzles']}"));
	?>
	</div>
	
</div>