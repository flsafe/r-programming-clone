<?php
class MarkdownHelper extends AppHelper{

  function parse($text){

    App::import('Vendor', 'markdown-extra/markdown');

    return $this->output(Markdown($text));
  }
}
?>