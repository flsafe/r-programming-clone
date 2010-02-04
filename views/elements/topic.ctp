<!--
Params:title,id, text, points, username
 -->

<div id="topics">
	<div class="topic">
		
		<div class="vote">
			<a href="#" id="<?php echo $id ?>" class="upvote" onClick="return false;">
				<img src="/img/up_arrow.gif" width="16" height="16"/>
			</a> 
			
			<a href="#" id="<?php echo $id ?>"onClick="return false;" class="downvote">
				<img src="/img/down_arrow.gif" width="16" height="16"/>
			</a>
		</div class="vote">
		
		<p class="title"> 
			<?php 
				echo $html->link($title, array('controller'=>'topics', 'action'=>'view', $id));
				echo "<br/>";
				if(isset($text))
					echo $text;
			?>
		</p>
	
		<div class="meta">
			<div class="metadata">
				
				<div id="<?php echo "points${id}"?>">
					<?php echo "$points points | " ?>
				</div>
				
				<div>
					<?php echo "by $username |" ?>
				</div>
				
				<div>
					<?php echo '<a href="">comments</a>' ?>
				</div>
				
			</div>
		</div>
		
	</div>
</div>