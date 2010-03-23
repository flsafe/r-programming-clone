<?php #params: 
			#topic   - A reference to the topic model to be displayed
			#user_id - The id of the user that is currently logged in.
			 
	$title           = $topic['Topic']['title'];
	$username        = $topic['User']['username'];
	$text            = $topic['Topic']['text'];
	$datastructures  = $topic['DataStructure'];
  $algorithms      = $topic['Algorithm'];

	$showedit = $user_id == $topic['Topic']['user_id'] ? true : false;
?>

<div id="selectedtopic">
	
	<h1><?php echo  $sanitizeUtil->htmlEscStr($title); ?> by <?php echo $sanitizeUtil->htmlEscStr($username); ?></h1>
	<p>
		<?php 
			echo $sanitizeUtil->markdownAndPurify($text);
		?>
	</p>

	<br/>
	<?php
		echo $this->element('topicdatastructs', array('algorithms'    =>$algorithms,
																						      'datastructures'=>$datastructures));
	?>
	<span class="meta">
		<?php
			if($showedit)
				echo $html->link("edit", array('controller'=>'topics', 'action'=>'edit', 'id'=>$topic['Topic']['id']));
		?>
	</span>
</div>