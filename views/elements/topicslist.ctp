<?php
	#params
	#topics    - A reference to the topics to display
	#uservotes - A refence to the user votes
	#loggedin  - Is the user logged in? Used to display things like the edit link 
?>
<div id="topics">
	
	<?php foreach($topics as $topic):?>
			<?php 
				echo $this->element('topic', array('topic'    => $topic,
																			    'uservotes' => $uservotes,
																			    'showedit'  => $loggedin ? true : false));
			?>
	<?php endforeach;?>
	
	<?php echo $this->element('pagination'); ?>
	
</div>