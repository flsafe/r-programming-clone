<?php
	#
	#Displays the content menu with the currently selected link highlighted. 
	#
?>

<div id="contentmenu">

	<div id="contentlinks">
	<?php
	  $selected = $session->read('selected');
	
		$sessionUser = $session->read('Auth.User');
		if($selected && !empty($sessionUser)){
		  $class            = array('today'=>'', 'puzzles'=>'', 'mysolutions'=>'', 'mypuzzles'=>'');
			$class[$selected] = 'selected';
		
			echo $html->link("Puzzles",         array('controller'=>'topics', 'action'=>'index'),
				                                  array('class'     =>"contentmenulink {$class['puzzles']}"));
				
			echo $html->link("My Solutions",    array('controller'=>'users', 'action'=>'review', 'modelname'=>'Submission'),
				                                  array('class'     =>"contentmenulink {$class['mysolutions']}"));
			
			echo $html->link("My Puzzles",      array('controller'=>'users', 'action'=>'review', 'modelname'=>'Topic'),
			                               			array('class'     =>"contentmenulink {$class['mypuzzles']}"));
		}
	?>
	</div>
	
</div>