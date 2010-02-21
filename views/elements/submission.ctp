<?php # id object - id
 			#vote - (up,down,none) 
			#text - display text under title if set
			#size - the size of the solution
			#points - Points to display
			#username - username to dispaly
?>
<div class="submission">

	<div class="submissioncode">
		<p>
			foreach x in range 10<br/>
				x pp<br/>
				if x gt 100<br/>
					print 10<br/>
				else<br/>
					count 20 10<br/>
			foreach y in range 100<br/>
				sum y  x</br>
				if sum lt 5<br/>
					docomp x y<br/>
			sum x y<br/>
			dofpr x y<br/>
			check b <br/>
			foreach y in range 100<br/>
				sum y  x</br>
				if sum lt 5<br/>
					docomp x y<br/>
		</p>
	</div>

	<div class="submissiontitle">

		<?php 
		 	echo $this->element('vote', array('id'=>$id, 'vote'=>$vote));
			echo $html->link($title, array('controller'=>'submissions', 'action'=>'view', $id));
			if(isset($text))
				echo $text;
		?>

	</div>

	<div class="submissionstats">
			<?php 
				echo "Size: $size <br/>" ;
				echo "Elegance: <br/>";
				echo "Efficiency: <br/>";
			?>
	</div>

	<?php
		echo $this->element('meta', array('id'       => $id,
																 			'points'   => $points,
																 			'username' => $username));
	?>
</div>

