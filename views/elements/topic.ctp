<!--
Params:title, text, points, username
 -->

<div id="topics">
	<div class="topic">
	
		<p class="title"> 
			
			<a href="">
				<img src="/img/up_arrow.gif" width="16" height="16"/>
			</a> 
			
			<?php 
				echo $html->link($title, array('controller'=>'topics', 'action'=>'view', $id));
				echo "<br/>";
				if(isset($text))
					echo $text;
			?>
		</p>
	
		<div class="meta">
			<div class="metadata">
			<?php echo "$points points | posted by $username | <a href=''>comments</a>" ?>
			</div>
		</div>
		
	</div>
		
</div>
