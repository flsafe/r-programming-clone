<?php 
	#Imports the javascript required for voting on the client side
	#params
	#votingFor - (Submission, Topic) Vote logic to import
	echo $javascript->link('json2min', false);
  echo $javascript->link('showdown', false);
	echo $javascript->link('jquery/comment', false);
?>