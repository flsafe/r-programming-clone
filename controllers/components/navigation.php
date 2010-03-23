<?php
#
# This class keeps track of what content menu item
# is currently selected. Used with contentmenu.ctp
#
class NavigationComponent extends object{
	
	public $components = array('Session');
	
	#Maps routes to content menu item
	private $show = array('/'                   => 'puzzles',
												'/myitems/Submission' => 'mysolutions',
												'/myitems/Topic'      => 'mypuzzles');

	#Don't show the content menu if the url contains these strings
	 private $noshow = array('/users/', '/pages/', '/contacts/');
	
	function initialize(&$controller){
      $this->controller = $controller;
  }
	
	function setContentMenuSelection(){
   # 
	 # Returns the content menu link that should 
	 # be displayed as selected in contentmenu.ctp
	 #

		$here = $this->controller->here;
		
		foreach($this->noshow as $url){
			if(strstr($here, $url))
				$this->Session->write('selected', false);
		}

		if(isset($this->show[$here])){
			$this->Session->write('lastselected', $this->show[$here]);
			$this->Session->write('selected', $this->show[$here]);
		}
		else{
			$this->Session->write('selected', $this->Session->read('lastselected'));
		}
	}
}
?>