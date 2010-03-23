<?php
	#params
	#algorithms     - The algorithms used in the HABTM format 
	#datastructures - The datastructures used in the HABTM format
?>
<div id="selectedtopicdatastructs">
	<p class="algorithms"><span class="algorithmslabel">Related Algorithms:</span> 
		<?php 
			for($i = 0 ; $i < count($algorithms) ; $i++){
				$a = $algorithms[$i];
				$sanitizeUtil->htmlEsc($a['name']);
				echo $a['name'];
				if($i != count($algorithms) - 1)
					echo ", ";
			}
		?>
	</p>
	
	<p class="datastructures"><span class="datastructureslabel">Related Datastructures: </span>
		<?php 
			for($i = 0 ; $i < count($datastructures) ; $i++){
				$d = $datastructures[$i];
				$sanitizeUtil->htmlEsc($d['name']);
				echo $d['name'];
				if($i != count($datastructures)-1)
					echo ", ";
			}
		?>
	</p>

</div>