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
					echo $html->link('Register', array('controller'=>'users', 'action'=>'login')) . $space;
				}
			?>
		</span>

		<a href="/submissions/index/"><img src="/img/codekettllogo.png"/></a>
		<img id="beta" src="/img/beta.png"/ height="50"/>
		<div><a href="/submissions/index/" id="tagline">Your Daily Cup Of Programming Interview Practice</a></div>
	</div>

	<div id="content">
		<?php echo $session->flash();?>
		<?php echo $content_for_layout;?>
	</div>		

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
