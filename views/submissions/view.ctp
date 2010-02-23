<?php
 	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('jquery/comment');
  $sanitizeUtil->htmlEsc($submission['Submission'], array('title', 'description1', 'id'));
?>

<div id="viewsubmission">
	
	<div id="viewsubmissionhead">	
		<h1>
			<?php echo $markdown->parse($submission['Submission']['title']); ?>
		</h1>

		<p>
			<?php echo $markdown->parse($submission['Submission']['description1']); ?>
		</p>
  </div>

	<div id='viewsubmissioncode'>
	<?php 
			$code = $submission['Submission']['text1']; 
			echo $syntaxHighlighter->highlight($code, 'java');
	?>
	</div>

	<?php
		$sanitizeUtil->htmlEsc($submission['Submission'], array('id'));
		$sanitizeUtil->htmlEsc($submission['Subission']['User'], array('username', 'id'));
	
		echo $this->element('comments', array('modelname'=>'Submission', 
															'model_id' => $submission['Submission']['id'],
															'username' => $submission['User']['username'],
															'user_id'=>$submission['User']['id']));
	?>

</div>