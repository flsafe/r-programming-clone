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
		#Display a list of line item models.
		
		$model->unbindModel(array('hasMany'=>array('Comment')), false);
		
		$user_id  = $this->Auth->user('id');
		$loggedin = $user_id ? true : false;
		
		$modelname  = $model->name;
		$models     = $this->controller->paginate("$modelname"); #TODO: Should be passed in
		$this->controller->set('models', $models);
		
		$this->controller->set('uservotes', array());
		$this->controller->set('user_id', $user_id);
		if($loggedin){
			$modelids  = $this->Common->toIdArray($models, $modelname);
			$uservotes = $this->controller->Vote->getUserVotes($modelname, $modelids, $user_id); #TODO: Vote should be passed in
			$this->controller->set('uservotes', $uservotes);  
		 }
	}
	
	public function showView(&$model, $id){
		#Show a line item model in isolation
		
		$model->unbindModel(array('hasMany'=>array('Comment')), false); #TODO: maybe these should alwasy be binded manually
		
		$user_id   = $this->Auth->user('id');
		$loggedin  = $user_id ? true : false;
		$this->controller->set('user_id', $user_id);
		
		$model->id = $id;
		$modelname = $model->name;		
		
		$modelMiss = false;
		$voteMiss  = false;
		
		$modelData = Cache::read("${modelname}.${id}", 'default');
		if(! $modelData){
			$modelData = $model->read();
			Cache::write("${modelname}.${id}", $modelData, 'default');
		}
		$this->controller->set('model', $modelData);
		
		$voteData = array();
		if($loggedin){
			$voteData  = Cache::read("Vote.${modelname}.${id}", 'default');
			if(! $voteData){
				$voteData = $this->controller->Vote->getUserVotes("$modelname", array($id), $user_id); #TODO: pass vote in
				Cache::write("Vote.${modelname}.${id}", $voteData, 'default');
			}
		}
		$this->controller->set('uservotes', $voteData);
	}
}
?>