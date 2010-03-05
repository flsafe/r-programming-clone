<?php #params: title, text, username ?>

<div id="selectedtopic">
	
	<h1><?php echo $title ?> by <?php echo $username ?></h1>
	<p><?php echo $text ?></p>
	<a href="/topics/index">
		<img id="morepuzzelsbutton" src="/img/morepuzzlesbutton.png" alt="view more puzzels" height="35"/>
	</a>
	
</div>