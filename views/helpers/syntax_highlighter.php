<?php
class SyntaxHighlighterHelper extends AppHelper{
	
	public function highlight($code, $lang){
		App::import('vendor', 'geshi/geshi');
		$g = new GeSHI($code, $lang);
		return $g->parse_code();
	}
}
?>