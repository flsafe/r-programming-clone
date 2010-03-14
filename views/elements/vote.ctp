<?php #params id - object id 
			#				vote - "up" or "down" or "none".
			
			$srcup   = array('up'   =>'/img/up_arrow_red.gif',   'down' => '/img/up_arrow.gif', 'none' => '/img/up_arrow.gif');
			$srcdown = array('down' =>'/img/down_arrow_red.gif', 'up' => '/img/down_arrow.gif',  'none'   => '/img/down_arrow.gif');
?>
<div class="votearrows">
	
	<a href="#" id="<?php echo "upvote${id}" ?>" class="upvote" onClick="return false;">
		<img id="<?php echo "upvoteimg${id}" ?>"src="<?php echo $srcup[$vote] ?>" width="34" height="21"/>
	</a> 
	
	<a href="#" id="<?php echo "downvote{$id}" ?>" class="downvote" onClick="return false;">
		<img id="<?php echo "downvoteimg${id}" ?>" src="<?php echo $srcdown[$vote] ?>" width="34" height="21"/>
	</a>
	
</div>