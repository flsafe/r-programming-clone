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

<body>
	
	<div id="header">

		<a href="/submissions/index/"><img src="/img/codekettllogo.jpg"/></a>

		<div id="menu">
			<?php 
				$space = "&nbsp;&nbsp;&nbsp;";

				if($loggedin){
					echo $html->link("My Profile", array('controller'=>'users', 'action'=>'edit')) . $space ;
					echo $html->link('Logout', array('controller'=>'users', 'action'=>'logout')) . $space;
					echo "<label id='loggedin'/>"; #Used to determine if the user is logged in from jquery
				}
				else{
					echo $html->link('Login', array('controller'=>'users', 'action'=>'login')) . $space;
					echo $html->link('Register', array('controller'=>'users', 'action'=>'login')) . $space;
				}
			?>
		</div>
	</div>


	<?php echo $session->flash();?>
	<?php echo $content_for_layout;?>

	<div id="footer">
		<div id="footerlinks">

		<?php 
			echo $html->link("About", array('controller'=>'pages', 'action'=>'about_us')). $space;
		?>
		<a href="">Feedback</a>&nbsp;&nbsp;
		<a href="">Blog</a>
		</div>
		
		<div id="footerlegal">
			&copy; 2010 
			<?php echo $html->link(' CozySystems LLC ', 'http://www.cozysystems.com');?>
		</div>
	</div>

</body>
</html>
