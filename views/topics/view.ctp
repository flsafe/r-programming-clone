<?php $sanitizeUtil->htmlEsc($topic['Topic'], array('title', 'text')); ?>

<h1>
<?php echo $topic['Topic']['title'];?>
</h1>

<br/>

<p>
<?php echo $topic['Topic']['text']?>
</p>