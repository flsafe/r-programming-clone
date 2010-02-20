<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Code Kettl</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<?php echo $html->css("default")?>
	<?php echo $scripts_for_layout?>
</head>

<body id="body">
	
	<div id="header">
		<?php echo $html->link('Code Kettl', array('controller'=>'submissions', 'action'=>'index'));?>
		[ The Better Way To Practice Programming ]
		<span id="menu">

			<?php echo $html->link("About", array('controller'=>'pages', 'action'=>'about_us'));?> 

			<?php 
				if($loggedin){
					echo $html->link("My Profile", array('controller'=>'users', 'action'=>'edit'));
					echo "<label id='loggedin'/>"; #Used to determine if the user is logged in from client"
				}
				if($loggedin){
					echo $html->link('Logout', array('controller'=>'users', 'action'=>'logout'));
				}
				else{
					echo $html->link('Login', array('controller'=>'users', 'action'=>'login'));
					echo $html->link('Register', array('controller'=>'users', 'action'=>'login'));
				}
			?>
		</span>
	</div>
	
	

		<?php 
			
		?>
	</div>

	<div id="content">
		<?php echo $session->flash();?>
		<?php echo $content_for_layout;?>
	</div>

	<div id="footer">
		<p id="legal">
			&copy; 2010 
			<?php 
				echo $html->link(' CozySystems LLC ', 'http://www.cozysystems.com');
			?>
		</p>
	</div>

</body>
</html>
