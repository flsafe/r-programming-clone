<?php
/**
 * This class keeps track of what content menu item
 * is current selected.
 */
class NavigationComponent extends object{
	
	/*Maps the route to what content menu item should be selected*/
	private $show = array('/'                   => 'today',
												'/puzzles'            => 'puzzles',
												'/myitems/Submission' => 'mysolutions',
												'/myitems/Topic'      => 'mypuzzles');

	/*Don't show the content menu if the url contains these strings*/
	 private $noshow = array('/users/', '/pages/');
	
	function startup(&$controller){
      $this->controller = $controller;
  }
	
	/**
	 * Return what content menu link should 
	 * be displayed as selected. 
	 */
	function getContentMenuSelection(){
		$here = $this->controller->here;
		
		foreach($this->noshow as $url){
			if(strstr($here, $url))
				return false;
		}

		if(isset($this->show[$here])){
			$this->controller->Session->write('lastselected', $this->show[$here]);
			return $this->show[$here];
		}
		else{
			return $this->controller->Session->read('lastselected');
		}
	}
}
?>