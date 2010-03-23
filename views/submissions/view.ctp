<?php
	echo $this->element('javascriptjquery');
	echo $this->element('javascriptcomment');
 	echo $this->element('javascriptvote', array('votingFor'=>'submissions'));
?>

<div id="viewsubmission">
	
	<div id="viewsubmissionhead">	
		<div id="viewsubmissionheadtitle">
			<?php
			 echo $this->element('submission', array('uservotes'     => $uservotes,
																					     '$user_id'      => $user_id,
																					     'submission'    => $model,
																					     'showeverything'=>false));
			?>
		</div>
		
		<p>
			<?php 
				echo $htmlPurifier->purify($markdown->parse($model['Submission']['description1'])); 
			?>
		</p>
  </div>

	<div id='viewsubmissioncode'>
		<?php 
				$code = $model['Submission']['text1'];
				echo $syntaxHighlighter->highlight($code, $model['Submission']['syntax']);
		?>
	</div>

	<?php
		echo $this->element('comments', array('modelname'=>'Submission', 
															            'model'    => $model,
															            'user_id'  => $user_id));
	?>

</div>