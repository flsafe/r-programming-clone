<?php
 	echo $javascript->link('jquery/jquery.min', false);
	echo $javascript->link('util', false);
	echo $javascript->link('showdown');
	echo $javascript->link('json2min');
	echo $javascript->link('jquery/comment');
	echo $javascript->link('jquery/submissions', false); #TODO: Defines some vars that enable votes on submissions
	echo $javascript->link('jquery/vote', false);
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
				$sanitizeUtil->htmlEsc($model['Submission'], array('description1'));
				echo $markdown->parse($model['Submission']['description1']); 
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