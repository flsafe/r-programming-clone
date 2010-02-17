<?php
class SanitizeUtilHelper extends Helper{


  public function htmlEsc(&$modeldata, $fields = array()){

    if(empty($modeldata))
      return;
	
		#TODO: Temporary hack to let a subset of the php mark down go through.
		$unescape    = array('&#40;', '&#41;');
		$replacewith = array('(', ')');

    App::import('Sanitize');

    foreach($fields as $field){
    	$modeldata[$field] = Sanitize::html($modeldata[$field]);

			if(!empty($unescape)){
				$modeldata[$field] = str_replace($unescape, $replacewith, $modeldata[$field]);
			}
    }
  }

	public function htmlEscStr($str){
		App::import('Sanitize');
		return Sanitize::html($str);
	}
}
?>