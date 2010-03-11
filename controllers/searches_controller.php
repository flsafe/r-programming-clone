<?php
App::import('Core', 'Sanitize');
class	SearchesController extends AppController{
		
		public $uses = array('SearchIndex', 'Vote');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('search');
		}
		
		/**
		 * Search the current model.
		 */
		public function search(){
			$this->autoRender = false;

			$searchText = Sanitize::escape($this->data['Search']['text']);
			$modelname  = $this->data['Search']['model'];
			if(! $this->Common->validModel($modelname))
				return;
			
			$this->paginate = array('limit' 		 => 25,
		                          'conditions' => "MATCH(SearchIndex.data) AGAINST('$searchText' IN BOOLEAN MODE)");
			$this->SearchIndex->searchModels(array($modelname));
			$results 				= $this->paginate('SearchIndex'); #returns the only the id fields of the matches
			$ids     				= $this->Common->toIdArray($results, $modelname);
			$this->paginate = array('limit'=>25,
															'order'=>array("{$modelname}.created" => 'asc'),
															'conditions'=>array("{$modelname}.id"=>$ids));
			$results = $this->paginate($modelname);
			$this->set('results', $results);
			
			$this->set('modelname', $modelname);			
			$this->set('user_id', '');
			$this->set('uservotes', array());
			$user_id = $this->Auth->user('id');
			if($user_id){
				$this->set('user_id', $user_id);
				$uservotes = $this->Vote->getUserVotes($modelname, $this->Common->toIdArray($results, $modelname), $user_id);
				$this->set('uservotes', $uservotes);
			}
			
			$this->render('/elements/searchresults');
		}
	}
?>