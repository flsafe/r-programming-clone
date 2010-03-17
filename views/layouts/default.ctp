<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Code Kettl</title>
	<meta name="keywords" content="Programming Practice Collaborate" />
	<meta name="description" content="Practice Programming Together" />
	<?php echo $html->css("default")?>
	<?php echo $scripts_for_layout?>
</head>

<body>
	
	<div id="header">
		
		<span id="menu">
			<?php 
				$space = "&nbsp;&nbsp;&nbsp;";

				if($loggedin){
					echo $html->link("$sessionusername", array('controller'=>'users', 'action'=>'edit')) . $space ;
					echo $html->link('Logout', array('controller'=>'users', 'action'=>'logout')) . $space;
					echo "<input id=\"loggedin\" name=\"{$sessionusername}\" type=\"hidden\"/>";
				}
				else{
					echo $html->link('Login', array('controller'=>'users', 'action'=>'login')) . $space;
					echo $html->link('Register', array('controller'=>'users', 'action'=>'add')) . $space;
				}
			?>
		</span>

		<?php echo $html->link($html->image('codekettllogo.png', array('alt'=>'logo', 'id'=>'logo')), array('controller'=>'submissions', 'action'=>'index'),
		                                                         array('alt'=>'codekettl logo'), false, false); 
		?>
		
		<div id="tagline">
			<?php echo $html->link('Your Daily Cup Of Programming Practice', array('controller'=>'submissions')); ?>
		</div>
	</div>

	<div id="sidebar">
		<p>Code Kettl is is a tool that lets you practice programing with other programmers.
		</p>
			<?php
				echo $form->create('Search',      array('controller'=>'searches', 
																								'action'    =>'search', 
																								'div'       =>false));
																								
				echo $form->input('Search.model', array('label'   =>false,
																								'type'    =>'select', 
																								'options' =>array('Submission'=>'Solutions','Topic'=>'Puzzles'),
																								'div'     =>false));																
												
				echo $form->input('Search.text',  
																				array('label' =>false, 
																							'div'   =>false, 
																							'value' =>'search'));
																							
				
				echo $form->end("Search");
				
				echo $javascript->link('jquery/jquery.min');
				echo $javascript->link('jquery/search');
			?>
			<div id="add">
				Your advertisement could be here! Details coming soon.
				<img id="addimg" src="/img/tps.png" height="200">
			</div>
	</div>

	<div id="content">
		<?php 
			if(isset($selected) && $selected)
				echo $this->element('contentmenu', array('selected'=>$selected));
			echo $session->flash();
			echo $content_for_layout;
		?>
	</div>		

	<div id="footer">
		<div id="footerlinks">

		<?php 
			echo $html->link('About', array('controller'=>'pages', 'action'=>'about_us')) . $space;
			echo $html->link('Feedback', array('controller'=>'contacts', 'action'=>'add')) . $space;
			echo $html->link('Blog', "http://www.cozysystems.com/blog").$space;
		?>
		</div>
	
		<div id="footerlegal">
			&copy; 2010 
			<?php echo $html->link(' CozySystems LLC ', 'http://www.cozysystems.com');?>
		</div>
	</div>

</body>

</html>
