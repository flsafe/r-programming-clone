<?php
	#params: title, text, username
?>

<div id="selectedtopic">
<?php 
echo $html->tag('h2', "$title by $username");
echo $html->tag('p', $text);
?>
</div>