<?php 
  $sanitizeUtil->htmlEsc($submission['Submission'], array('title', 'description1'));
?>

<h2>
	<?php echo $markdown->parse($submission['Submission']['title']); ?>
</h2>

<p>
	<?php echo $markdown->parse($submission['Submission']['description1']); ?>
</p>

<p>
	<div id='srccode'>
	<?php 
		$code = $submission['Submission']['text1']; 
		echo $syntaxHighlighter->highlight($code, 'java');
	?>
	</div>
</p>

