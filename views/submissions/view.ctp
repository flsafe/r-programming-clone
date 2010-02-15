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

<?php
	echo $this->element('comments', array('modelname'=>'Submission', 
														'model_id' => $submission['Submission']['id'],
														'username' => $submission['User']['username'],
														'user_id'=>$submission['User']['id']));
?>
