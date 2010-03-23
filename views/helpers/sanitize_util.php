<?php
App::import('Sanitize');

class SanitizeUtilHelper extends Helper{
	
	public $helpers = array('Markdown', 'HtmlPurifier');
	
	/**
	 * Escapes html chars except for '(' and ')'.
	 * $modeldata - A model array like: commentdata['Comment']
	 */
  public function htmlEsc(&$modeldata,$fields = array()){

    if(empty($modeldata))
      return;

    foreach($fields as $field)
    	$modeldata[$field] = Sanitize::html($modeldata[$field]);

  }

	public function markDownAndPurify($text){
		$text = $this->Markdown->parse($text);
		$text = $this->HtmlPurifier->purify($text);
		return $text;
	}

	public function htmlEscStr(&$str){
		return Sanitize::html($str);
	}
}
?>