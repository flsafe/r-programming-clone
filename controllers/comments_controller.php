<?php
class CommentsController extends AppController{
	public $name = 'Comments';
	
	public $component = array('RequestHandler', 'Auth');
	
	public $uses = array('Comment', 'Submission');
	
	public $models = array('Submission', 'Topic');
	
	public function beforeFilter(){
		$this->Auth->allow(array('comment', 'model_comments')); #TEMP for testing
	}
	
	public function model_comments($modelname, $modelid){
		if(! in_array($modelname, $this->models))
			return;
			
		if(!$modelid)
			return;
		
		$data = $this->Comment->getModelComments($modelname, $modelid, null);

		return $data;
	}
	
	public function user_comments(){
		
	}
	
	public function comment($modelname, $model_id, $parent_id, $text){
		$this->autoRender = false;
		/*if(!$this->RequestHandler->isAjax())
			return;*/ #Not doing ajax while in development
		
		if(! in_array($modelname, $this->models))
			return;
			
		if(!$text)
			return;
			
		$userdata = $this->Auth->user();
		if(empty($userdata))
			return;
			
		$replyingToComment = $parent_id != '0';
		if($replyingToComment){
			$submissiondata = $this->Comment->findById($parent_id);
			$noCommentExists  = empty($submissiondata);
			if($noCommentExists)
				return;	
		}
			
		$this->Comment->commentOnModel($modelname, $model_id, $parent_id, $userdata['User']['id'], $text);
	}
}
?>