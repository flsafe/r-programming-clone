<?php #params id, points, username ?>
	<div class="meta">
		<div class="metadata">
			
			<div id="<?php echo "points${id}"?>">
				<?php echo "$points" ?>
			</div>
			
			<?php echo " points | by" ?>
			
			<div>
				<?php echo "$username" ?>
			</div>
			
			<?php echo " | " ?>
			
			<div>
				<?php echo '<a href="">comments</a>' ?>
			</div>
			
		</div>
	</div>