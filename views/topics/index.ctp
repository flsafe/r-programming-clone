<h1>Up Comming Discussion Topics</h1>
<?php echo $html->link("Submit your topic", array('controller'=>'topics', 'action'=>'add'));?>
<table border="0" cellspacing="5" cellpadding="5">
	
	<?php foreach($topics as $topic):?>
	<tr><td>
		
		<?php echo $html->link($topic['Topic']['title'],
		 											 array('controller'=>'topics', 'action'=>'view', $topic['Topic']['id']))?> 
		
	</td></tr>
	<?php endforeach;?>
	
</table>