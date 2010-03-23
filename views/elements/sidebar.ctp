<?php
	echo $this->element('javascriptjquery');
	echo $javascript->link('jquery/search');
?>

<div id="sidebar">
	<p>
		CodeKettl is the funnest way to practice your programming skills and learn from other programmers.
	</p>
	<p>
		Browse tough programming puzzles, share your solutions, get feedback, get better, learn together!
	</p>
		<?php
			echo $form->create('Search',      array('controller'=>'searches', 
																							'action'    =>'search', 
																							'div'       =>false));
																							
			echo $form->input('Search.model', array('label'     =>false,
																							'type'      =>'select', 
																							'options'   =>array('Submission'=>'Solutions','Topic'=>'Puzzles'),
																							'div'       =>false));																
											
			echo $form->input('Search.text',  array('label'     =>false, 
																						'div'         =>false, 
																						'value'       =>'search'));
			echo $form->end("Search");
		?>
		
		<div id="add">
			<p>Your advertisement or job listing could be here! Details coming soon.</p>
			<img id="addimg" src="/img/tps.png" height="200">
		</div>
		
</div>