<?php #params: title, text, username ?>

<div id="selectedtopic">
	
	<h2><?php echo $title ?> by <?php echo $username ?></h2>
	<p><?php echo $text ?></p>
	<a href="/topics/index">
		<img id="morepuzzelsbutton" src="/img/morepuzzles.png" alt="view more puzzels"/>
	</a>
	
</div>