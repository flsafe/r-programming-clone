<?php 
  $sanitizeutil->htmlEsc($submission['Submission'], array('title', 'text1', 'description1'));
?>

<h2>
	<?php echo $submission['Submission']['title']; ?>
</h2>

<p>
	<?php echo $submission['Submission']['text1']; ?>
</p>

<p>
  <?php echo $submission['Submission']['description1']; ?>
</p>