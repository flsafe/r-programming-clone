<?php 
  $sanitizeUtil->htmlEsc($submission['Submission'], array('title', 'text1', 'description1'));
?>

<h2>
	<?php $markdown->parse($submission['Submission']['title']); ?>
</h2>

<p>
  <?php echo $submission['Submission']['description1']; ?>
</p>

<p>
	<?php echo $submission['Submission']['text1']; ?>
</p>

