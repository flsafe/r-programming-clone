<?php #params id, points, username ?>
	<div class="meta">
			<span id="<?php echo "points${id}"?>" class="metadatapoints">
				<?php echo "$points" ?>
			</div>
			
			<?php echo " points | by" ?>
			
			<div class="metadatausername">
				<?php echo "$username" ?>
			</div>
			
			<?php echo " | " ?>
			
			<span class="metadatacomments">
				<?php echo '<a href="">comments</a>' ?>
			</span>

	</div>