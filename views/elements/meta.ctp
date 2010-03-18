<?php 
		#params 
		#modelname      - The name of the model being displayed
		#model          - The model to display metadata for
		#userid         - Currently logged in user id
		
		App::import('Core', 'Inflector');
		
		if(!isset($showeverything))
			$showeverything = true;
			
		$id       = $model[$modelname]['id'];
		$points   = $model[$modelname]['upvotes'] - $model[$modelname]['downvotes'];
		$username = $model['User']['username'];
		$showedit = $user_id == $model['User']['id'] ? true : false;
?>
<span class="meta">

	<span id="<?php echo "points${id}"?>" class="metadatapoints">
		<?php 
			if(abs($points) > 1 || $points == 0)
				echo "$points points | by ";
			else
				echo "$points point | by ";
		?>
	</span>
	
	<span>
		<?php 
			echo "$username";
			
			if($showedit){
				echo " | ";
			  $controller = Inflector::pluralize(Inflector::underscore(strtolower($modelname)));
				echo $html->link("edit", array('controller'=>"$controller", 'action'=>'edit', 'id'=>"$id"));
			}
		?>
	</span>

</span>