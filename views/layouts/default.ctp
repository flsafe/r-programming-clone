<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>CodeKettl</title>
	<meta name="keywords" content="Programming Practice Collaborate" />
	<meta name="description" content="Practice Programming Together" />
	<?php 
		echo $html->css("default");
	  echo $scripts_for_layout;
	?>
</head>

<body>

	<?php 
		echo $this->element('header');
		echo $this->element('sidebar'); 
	?>

	<div id="content">
		<?php 
			echo $this->element('contentmenu');
			echo $session->flash();
			echo $content_for_layout;
		?>
	</div>		

	<?php echo $this->element('footer') ?>

</body>

</html>
