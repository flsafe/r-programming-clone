<?php
App::import('Vendor', 'htmlpurifier/library/HTMLPurifier.auto');
App::import('Vendor','HTMLPurifier' ,array('file'=>'htmlpurifier'.DS.'library'.DS.'HTMLPurifier.auto.php'));

class HtmlPurifierHelper extends AppHelper{
	
	private $purifier = false;
	
	function purify($str){
		$config = HTMLPurifier_Config::createDefault();
		$config->set('HTML.TidyLevel', 'none');
		
		if(!$this->purifier)
			$this->purifier = new HTMLPurifier($config);
		
		return $this->purifier->purify($str);
	}
	
}
?>