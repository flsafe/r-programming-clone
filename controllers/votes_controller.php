<?php
	class VotesController extends AppController{
		
		public $components = array("RequestHandler");
		
		public $uses = array("Vote", "Submission", "Topic");
		
		public function vote( $type = null, $model = null, $id = null){
			$this->autoRender = false;
			
			if(! $this->RequestHandler->isAjax())
				return;
			
			if($type != 'up' && $type != 'down'){
				$this->log("Not valid vote: $type");
				return;
			}
			
			$submission = $this->Submission;
			$topic      = $this->Topic;
			$models = array("Submission" => $submission, 
											"Topic"      => $topic);
			if(!isset($models[$model])){
				$this->log("Not found $model");
				return;
			}
			
			$userid = $this->Auth->user('id');
			if(!$userid){
				$this->log("Not logged in");
				return;
			}

			$points = $this->Vote->voteForModel($type, $models[$model], $id, $userid);
			echo json_encode(array('points'=>$points));
		}
	}
?>