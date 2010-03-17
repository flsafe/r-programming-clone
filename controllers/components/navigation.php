<?php
/**
 * This class keeps track of what content menu item
 * is currently selected. Used with contentmenu.ctp
 */
class NavigationComponent extends object{
	
	public $components = array('Session');
	
	/*Maps the route to content menu item*/
	private $show = array('/'                   => 'today',
												'/puzzles'            => 'puzzles',
												'/myitems/Submission' => 'mysolutions',
												'/myitems/Topic'      => 'mypuzzles');

	/*Don't show the content menu if the url contains these strings*/
	 private $noshow = array('/users/', '/pages/', '/contacts/');
	
	function initialize(&$controller){
      $this->controller = $controller;
  }
	
	/**
	 * Return what content menu link should 
	 * be displayed as selected. Is this function
	 * to set the selected param for the contentmenu.ctp
	 */
	function getContentMenuSelection(){
		$here = $this->controller->here;
		
		foreach($this->noshow as $url){
			if(strstr($here, $url))
				return false;
		}

		if(isset($this->show[$here])){
			$this->Session->write('lastselected', $this->show[$here]);
			return $this->show[$here];
		}
		else{
			return $this->Session->read('lastselected');
		}
	}
}
?>