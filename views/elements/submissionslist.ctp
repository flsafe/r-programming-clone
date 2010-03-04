<?php
	#params
	#submissions - An array of submissions to display in the format returned by model find methods
	#uservotes   - (optional, default shows no voting data)
	#								The votes associated with each submission. Used to display the right up/down arrows.
	#loggedin    - (optional, default is logged out)
	#					     'true' if the current user is logged in, false by default. Used for things like 
	#  							displaying the 'reply' link.
?>
<div id="submissions">
	
	<?php foreach($submissions as $submission):?>
		<?php echo $this->element('submission', array('submission' => $submission,
		    																		 			'uservotes'  => $uservotes,
																									 'showedit'  => $loggedin ? true : false)) 
		?>
	<?php endforeach; ?>
	
</div>

<?php $this->element('pagination') ?>