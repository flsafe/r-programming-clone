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

		//$this->log("BEFORE SANITIZE");
		//$this->log(print_r($modeldata, true));
	
		#TODO: Temporary hack to let a subset of the php mark down chars go through.
		/*$unescape    = array('&#40;', '&#41;', '&#45;', '&quot;');
		$replacewith = array('(',     ')',     '-',      '"');*/


    foreach($fields as $field){
    	$modeldata[$field] = Sanitize::html($modeldata[$field]);

			if(!empty($unescape)){
				$modeldata[$field] = str_replace($unescape, $replacewith, $modeldata[$field]);
			}
    }
		//$this->log("AFTER SANITIZE");
		//$this->log(print_r($modeldata, true));
  }

	public function htmlEscStr($str){
		return Sanitize::html($str);
	}
}
?>