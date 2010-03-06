<?php
 	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('util', false);
	echo $javascript->link('showdown');
	echo $javascript->link('jquery/comment');
	echo $javascript->link('jquery/submissions', false); #TODO: Defines some vars that enable votes on submissions
	echo $javascript->link('jquery/vote', false);
?>

<div id="viewsubmission">
	
	<div id="viewsubmissionhead">	
		<div id="viewsubmissionheadtitle">
			<?php
			 echo $this->element('submission', array('uservotes' => $uservotes,
																					     '$user_id'  => $user_id));
			?>
		</div>
		
		<p>
			<?php 
				$sanitizeUtil->htmlEsc($submission['Submission'], array('description1'));
				echo $markdown->parse($submission['Submission']['description1']); 
			?>
		</p>
  </div>

	<div id='viewsubmissioncode'>
		<?php 
				$code = $submission['Submission']['text1'];
				echo $syntaxHighlighter->highlight($code, $submission['Submission']['syntax']);
		?>
	</div>

	<?php
		echo $this->element('comments', array('modelname'=>'Submission', 
															'model_id' => $submission['Submission']['id'],
															'username' => $submission['User']['username'],
															'user_id'  => $submission['User']['id']));
	?>

</div>