<?php
App::import('Component', 'Common');

class LineItemComponent extends Object{
	
	private $common;
	
	function startup(&$controller)
  {
      $this->controller = $controller;
			$this->common     = new CommonComponent();
  }
	
	public function showIndex(&$model){
  	$model->unbindModel(array('hasMany'=>array('Comment')), false);
		$modelname  = $model->name;
		
		$models = $this->controller->paginate("$modelname");
		$this->controller->set('models', $models);
		
		$this->controller->set('uservotes', array());
		$user_id    =  $this->controller->Auth->user('id');
		$this->controller->set('user_id', $user_id);
		if($user_id){
			$modelids = $this->common->toIdArray($models, $modelname);
			$uservotes = $this->controller->Vote->getUserVotes($modelname, $modelids, $user_id);
			$this->controller->set('uservotes', $uservotes);
		}
	}
	
	public function showView(&$model, $id){
		$model->unbindModel(array('hasMany'=>array('Comment')), false);
		$model->id = $id;
		$data = $model->read();
		$this->controller->set('model', $data);
		
		$this->controller->set('uservotes', array());
		$user_id = $this->controller->Auth->user('id');
		$this->controller->set('user_id', $user_id);
		$this->log("user id: {$user_id}");
		if($user_id){
			$uservotes = $this->controller->Vote->getUserVotes("{$model->name}", array($id), $user_id);
			$this->controller->set('uservotes', $uservotes);
		}
	}
}
?>