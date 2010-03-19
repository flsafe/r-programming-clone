<?php
App::import('Core', 'Cache');

/**
 * Displays line item models. Line item models are those things on the front page
 * in boxes. They are user submissions and user topics. 
 * They all have meta data (points, username),  votes and comments.
 * TODO: Refactor the line items into some kind of hierarchy
 */
class LineItemComponent extends Object{
	
	public $components = array('Common', 'Auth');
	
	function startup(&$controller)
  {
      $this->controller = $controller;
  }
	
	public function showIndex(&$model){
		#Display a list of line item models. Logged out users 
		#get a cached view of the line item models.
		
		$user_id  = $this->Auth->user('id');
		$loggedin = $user_id ? true : false;
		
		$model->unbindModel(array('hasMany'=>array('Comment')), false);
		$modelname  = $model->name;

		$models;                                  
		$this->controller->set('uservotes', array());
		$this->controller->set('user_id', $user_id);
		
		if(!$loggedin){
			#Serve cached models
			$models = Cache::read('models');
			if($models){
				$this->controller->set('models', $models);
			}
			else{
				$models = $this->controller->paginate("$modelname");
				$this->controller->set('models', $models);
				Cache::write('models', $models, 'lineitems');
			}
		}
		else{
			$models = $this->controller->paginate("$modelname"); #TODO: Paginate should be passed in
			$this->controller->set('models', $models);
		
			$modelids  = $this->Common->toIdArray($models, $modelname);
			$uservotes = $this->controller->Vote->getUserVotes($modelname, $modelids, $user_id); #Vote should be passed in
			$this->controller->set('uservotes', $uservotes);  #data here
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
		
		if($user_id){
			$uservotes = $this->controller->Vote->getUserVotes("{$model->name}", array($id), $user_id);
			$this->controller->set('uservotes', $uservotes);
		}
	}
}
?>