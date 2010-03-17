<?php 
	#Imports the javascript required for voting on the client side
	
	#params
	#votingFor - (Submission, Topic) Vote logic to import
	
	echo $javascript->link('jquery/jquery.min', false); 
	echo $javascript->link('util', false);

	if($votingFor == 'submissions')
		echo $javascript->link('jquery/submissions', false);
	else
		echo $javascript->link('jquery/topics', false);
		
	echo $javascript->link('jquery/vote', false);
?>