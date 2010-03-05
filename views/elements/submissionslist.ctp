<?php
	#params
	#submissions - An array of submissions to display in the format returned by model find methods
	#uservotes   - (optional, default shows no voting data)
	#								The votes associated with each submission. Used to display the right up/down arrows.
	#user_id    - What is the id of the current user? Used to display user specific links like 'edit'
	#					     
	#  						
?>
<div id="submissions">
	
	<?php foreach($submissions as $submission):?>
		<?php echo $this->element('submission', array('submission' => $submission,
		    																		 			'uservotes'  => $uservotes,
																									 'showedit'  => 
																									$user_id == $submission['Submission']['user_id'] ? true : false)) 
		?>
	<?php endforeach; ?>
	
</div>

<?php $this->element('pagination') ?>