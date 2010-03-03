<?php
class CommentsController extends AppController{
	public $name      = 'Comments';
	
	public $component = array('RequestHandler', 'Auth');
	
	public $uses      = array('Comment', 'Submission');
	
	public $models    = array('Submission', 'Topic');
	
	public function beforeFilter(){
		$this->Auth->allow(array('add', 'model_comments')); #TODO TEMP for testing
	}
	
	public function model_comments($modelname, $modelid){
		if(! in_array($modelname, $this->models))
			return;
			
		if(!isset($modelid))
			return;

		return $this->Comment->getModelComments($modelname, $modelid, null);
	}
	
	public function user_comments(){
		
	}
	
	public function add($modelname, $model_id, $parent_id){
		$this->autoRender = false;
		
		/*if(!$this->RequestHandler->isAjax())
			return;*/ #TODO Not doing ajax while in development
			
		$this->log("***********");
		$this->log(print_r($this->params,true));
		
		if(empty($this->params) || empty($this->params['form']['text']))
			return;
		
		if(! in_array($modelname, $this->models))
			return;
			
		$userdata = $this->Auth->user();
		if(empty($userdata))
			return;
			
		$replyingToComment = $parent_id != '0';
		if($replyingToComment){
			$submissiondata   = $this->Comment->findById($parent_id);
			$noCommentExists  = empty($submissiondata);
			if($noCommentExists)
				return;	
		}
			
		$this->Comment->commentOnModel($modelname, $model_id, $parent_id, $userdata['User']['id'], $this->params['form']['text']);
	}
}
?>