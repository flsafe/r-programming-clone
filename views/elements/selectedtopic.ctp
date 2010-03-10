<?php #params: 
			#title - The title of the topic
			#text  - The topic text (The actual puzzle)
			#username - The username of the author
			#algorithms - The related algorithms
			#datastructures - The related datastructures
?>

<div id="selectedtopic">
	
	<h1><?php echo $title ?> by <?php echo $username ?></h1>
	<p><?php echo $text ?></p>

	<br/>
	<?php
		echo $this->element('topicdatastructs', array('algorithms'    =>$algorithms,
																						 'datastructures'=>$datastructures));
	?>
</div>