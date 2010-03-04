<?php 
		#params 
		#modelname - The name of the model this meta data is asscociated with
		#id - The model id
		#points - The number of points to display
		#username - The username to display
		#showedit - Should the edit link be show? Usually it is only shown when a
		#            a user is logged in.
		App::import('Core', 'Inflector');
?>
<span class="meta">
	
			<span id="<?php echo "points${id}"?>" class="metadatapoints">
				<?php echo "$points points | by" ?>
			</span>
			
			<span>
				<?php 
					$controller = Inflector::pluralize(Inflector::underscore(strtolower($modelname)));
					echo $html->link(" $username ", array());
					

					if($showedit){
						echo "| ";
						echo $html->link("edit", array('controller'=>"$controller", 'action'=>'edit', 'id'=>"$id"));
					}
				?>
			</span>

</span>