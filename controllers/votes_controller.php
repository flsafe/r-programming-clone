<?php
	class VotesController extends AppController{
		
		public $components = array("RequestHandler");
		
		public $uses = array("Vote", "Submission", "Topic");
		
		public function vote( $type = null, $model = null, $id = null){
			$this->autoRender = false;
			
			if(! $this->RequestHandler->isAjax())
				return;
			
			if($type != 'up' && $type != 'down'){
				return;
			}
			
			$submission = $this->Submission;
			$topic      = $this->Topic;
			$models     = array("Submission" => $submission, 
											    "Topic"      => $topic);
			if(!isset($models[$model]))
				return;
				
			$userid = $this->Auth->user('id');
			if(!$userid)
				return;
				
			$this->Vote->voteForModel($type, $models[$model], $id, $userid);
		}
	}
?>