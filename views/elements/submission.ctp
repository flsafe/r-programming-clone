<div id="topics">
	<div class="topic">
	
		<p class="title"> 
			<a href="">
				<img src="/img/up_arrow.gif" width="16" height="16"/>
			</a> 
			<?php 
				echo $html->link($title, array('controller'=>'submissions', 'action'=>'view', $id));
			?>
		</p>
	
		<div class="text">
			
			<p>
				<?php 
					echo "Size: $size <br/>" ;
					echo "Efficiency: <br/>";
					echo "Readability: <br/>";
					echo "Elegance: <br/>";
				?>
			</p>
			
		</div>
	
		<div class="meta">
			<div class="metadata">
			<?php echo "$points points | posted by $username | <a href=''>comments</a>" ?>
			</div>
		</div>
		
	</div>
		
</div>
