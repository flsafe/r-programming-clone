<?php
/**
*	This class is temp hack. Until I refactor the model names
* this class will be used to translate the model names for display
* in the view.
*/
class TranslatorHelper extends AppHelper{
	
	private $translations = array('Topic'=>'Puzzle', 'Submission'=>'Solution');
	
	public function toViewName($name){
		if(isset($this->translations[$name]))
			return $this->translations[$name];
		else
			return false;
	}
}
?>