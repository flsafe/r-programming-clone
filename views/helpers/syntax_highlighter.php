<?php
App::import('vendor', 'geshi/geshi');
SyntaxHighlighterHelper::$_geshi = new GeSHI();
class SyntaxHighlighterHelper extends AppHelper{
	
	public static $_geshi;
	
	public function highlight($code, $lang){
		self::$_geshi->set_source($code);
		self::$_geshi->set_language($lang);
		self::$_geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
		self::$_geshi->set_header_type(GESHI_HEADER_DIV);
		return self::$_geshi->parse_code();
	}
}
?>