<?php #params id ?>
<div class="vote">
	<a href="#" id="<?php echo "upvote${id}" ?>" class="upvote" onClick="return false;">
		<img id="<?php echo "upvoteimg${id}" ?>"src="/img/up_arrow.gif" width="16" height="16"/>
	</a> 
	
	<a href="#" id="<?php echo "downvote{$id}" ?>" class="downvote" onClick="return false;">
		<img id="<?php echo "downvoteimg${id}" ?>" src="/img/down_arrow.gif" width="16" height="16"/>
	</a>
</div class="vote">