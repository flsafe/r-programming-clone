<!--
Params:title,id, text, points, username
 -->

<div id="topics">
	<div class="topic">
		
		<?php
			echo $this->element('vote', array('id'=>$id));
		?>
		
		<p class="title"> 
			<?php 
				echo $html->link($title, array('controller'=>'topics', 'action'=>'view', $id));
				echo "<br/>";
				if(isset($text))
					echo $text;
			?>
		</p>
	
		<?php echo $this->element('meta', array('id'  => $id,
																			 'points'   => $points,
																			 'username' => $username)); 
		?>
	</div>
</div>