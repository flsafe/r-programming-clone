<?php
	#params
	#submissions - An array of submissions to display in the format returned by model find methods
	#uservotes   - (optional, default shows no voting data)
	#								The votes associated with each submission. Used to display the right up/down arrows.
	#user_id     - What is the id of the current user? Used to display user specific links like 'edit'
	#showtopic   - Show the title of the associated topic (optional default false)
	
	if(! isset($showtopic))
		$showtopic = false;
?>
<div id="submissions">
	
	<?php foreach($submissions as $submission):?>
		<?php echo $this->element('submission', array('submission' => $submission,
		    																		 			'uservotes'  => $uservotes,
																									 'user_id'   => $user_id,
																									 'showtopic' => $showtopic));
		?>
	<?php endforeach; ?>
	
</div>

<?php echo $this->element('pagination') ?>