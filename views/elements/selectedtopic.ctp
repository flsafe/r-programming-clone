<?php #params: title, text, username ?>

<div id="selectedtopic">
	
	<h1><?php echo $title ?> by <?php echo $username ?></h1>
	<p><?php echo $text ?></p>
	<a href="/topics/index">
		<img id="morepuzzelsbutton" src="/img/morepuzzles.png" alt="view more puzzels"/>
	</a>
	
</div>