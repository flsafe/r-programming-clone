<?php
App::import('Sanitize');

class SanitizeUtilHelper extends Helper{

	/**
	 * Escapes html chars except for '(' and ')'.
	 * $modeldata - A model array like: commentdata['Comment']
	 */
  public function htmlEsc(&$modeldata, $fields = array()){

    if(empty($modeldata))
      return;

    foreach($fields as $field){
    	$modeldata[$field] = Sanitize::html($modeldata[$field]);

			if(!empty($unescape)){
				$modeldata[$field] = str_replace($unescape, $replacewith, $modeldata[$field]);
			}
    }
  }

	public function htmlEscStr($str){
		return Sanitize::html($str);
	}
}
?>