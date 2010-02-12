<?php 

  $sanitizeUtil->htmlEsc($submission['Submission'], array('title', 'text1', 'description1'));
?>

<h2>
	<?php echo $markdown->parse($submission['Submission']['title']); ?>
</h2>

<p>
<?php echo $markdown->parse( $submission['Submission']['description1']); ?>
</p>

<p>
<?php echo $markdown->parse($submission['Submission']['text1']); ?>
</p>

