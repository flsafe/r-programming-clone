<div class="pagination">
<p>
<?php  
	echo $paginator->prev('< Previous', null, null);
	echo "&nbsp;";
 	echo $paginator->next(' Next >', null, null); 
?>
</p>
</div>