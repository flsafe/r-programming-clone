<?php
class CommentsController extends AppController{
	public $name       = 'Comments';
	
	public $components = array('RequestHandler');
	
	public $uses       = array('Comment', 'Submission');
	
	public $models     = array('Submission', 'Topic');
	
	public function beforeFilter(){
		$this->Auth->allow(array('model_comments'));
	}
	
	public function model_comments($modelname, $modelid){
		if(! in_array($modelname, $this->models))
			return;

		return $this->Comment->getModelComments($modelname, $modelid);
	}
	
	public function user_comments(){
		
	}
	
	public function add($modelname, $model_id, $parent_id){
		$this->autoRender = false;
		
		if(!$this->RequestHandler->isAjax())
			return;
		
		$emptyComment = empty($this->params) || empty($this->params['form']['text']);
		if($emptyComment)
			return;
		
		$modelDoesNotExist = ! in_array($modelname, $this->models);
		if($modelDoesNotExist)
			return;
			
		$userdata    = $this->Auth->user();
		$notLoggedIn = empty($userdata);
		if($notLoggedIn)
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