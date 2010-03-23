<?php
	#params
	#topics    - A reference to the topics to display
	#uservotes - A refence to the user votes
	#user_id   - The id of the logged in user
?>
<div id="topics">
	
	<?php foreach($topics as $topic):?>
			<?php 
				echo $this->element('topic', array('topic'    => $topic,
																			    'uservotes' => $uservotes,
																			     'user_id'  => $user_id));
			?>
	<?php endforeach;?>
	
	<?php echo $this->element('pagination'); ?>
	
</div>