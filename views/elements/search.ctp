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