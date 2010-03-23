<div id="footer">
	<div id="footerlinks">

	<?php 
	  $space = "&nbsp;&nbsp;&nbsp;";
		echo $html->link('About', array('controller'=>'pages', 'action'=>'about_us')) . $space;
		echo $html->link('Feedback', array('controller'=>'contacts', 'action'=>'add')) . $space;
		echo $html->link('Blog', "http://www.cozysystems.com/blog").$space;
	?>
	</div>

	<div id="footerlegal">
		<?php echo "&copy;".date('Y') ?>
		<?php echo $html->link(' CozySystems LLC ', 'http://www.cozysystems.com');?>
	</div>
</div>