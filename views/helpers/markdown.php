<?php
App::import('Vendor', 'markdown-extra/markdown');

class MarkdownHelper extends AppHelper{

  function parse($text){
    return $this->output(Markdown($text));
  }
}
?>