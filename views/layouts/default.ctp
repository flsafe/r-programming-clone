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
	
	<div id="menu">
		<ul>
			
			<li <?php echo $loggedin ? "class='first'" : ""?> > 
				<?php echo $html->link("About", array('controller'=>'pages', 'action'=>'about_us'));?> 
			</li>
			
			<li <?php echo $loggedin ? "" : "class='first'"?>> 
				<?php 
					if($loggedin){
						echo $html->link("My Profile", array('controller'=>'users', 'action'=>'edit'));
						echo "<label id='loggedin'/>"; #Used to determine if the user is logged in from client"
					}
				?>
			</li>
			
			<li> 
				<?php 
					if($loggedin){
						echo $html->link('Logout', array('controller'=>'users', 'action'=>'logout'));
					}
					else{
						echo $html->link('Login', array('controller'=>'users', 'action'=>'login'));
						echo $html->link('Register', array('controller'=>'users', 'action'=>'login'));
					}
				?> 
			</li>
		
		</ul>
	</div>

	<div id="header">
		<h1><?php echo $html->link('Code Kettl', array('controller'=>'submissions', 'action'=>'index'));?></h1>
		<h2>[ The Better Way To Practice Programming ]</h2>
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
