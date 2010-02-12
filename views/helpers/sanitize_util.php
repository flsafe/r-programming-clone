<?php
class SanitizeUtilHelper extends Helper{


  public function htmlEsc(&$modeldata, $fields = array()){
	
		#Temporary hack to let a subset of the php mark down go through.
		$unescape    = array('&#40;', '&#41;');
		$replacewith = array('(', ')');

    App::import('Sanitize');

    $this->log(print_r($modeldata, true));

    foreach($fields as $field){
    	$modeldata[$field] = Sanitize::html($modeldata[$field]);

			if(!empty($unescape)){
				$modeldata[$field] = str_replace($unescape, $replacewith, $modeldata[$field]);
			}
    }

    $this->log(print_r($modeldata, true));
  }
}
?>