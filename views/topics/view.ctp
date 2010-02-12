<?php $sanitizeUtil->htmlEsc($topic['Topic'], array('title', 'text')); ?>

<h1>
<?php echo $markdown->parse($topic['Topic']['title']);?>
</h1>

<br/>

<p>
<?php echo $markdown->parse($topic['Topic']['text']);?>
</p>