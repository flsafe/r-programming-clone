<?php
class CommentsController extends AppController{
	public $name       = 'Comments';
	
	public $components = array('RequestHandler');
	
	public $uses       = array('Comment', 'Submission', 'Topic');
	
	public $models     = array('Submission', 'Topic');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('model_comments'));
	}
	
	/**
	 * Returns all the comments associated to a model
	 */
	public function model_comments($modelname, $modelid){
		if(! in_array($modelname, $this->models))
			return;

		return $this->Comment->getModelComments($modelname, $modelid);
	}
	
	/**
	 * Save a comment to a specific model
	 */
	public function add($modelname, $model_id, $parent_id, $tag){
		$this->autoRender = false;
		
		if(!$this->RequestHandler->isAjax())
			return;
		
		$emptyComment = empty($this->params) || empty($this->params['form']['text']);
		if($emptyComment)
			return;
		
		$modelDoesNotExist = ! in_array($modelname, $this->models);
		if($modelDoesNotExist)
			return;
			
		$commentOn = array('Submission'=>$this->Submission, 'Topic'=>$this->Topic);
		$m = $commentOn[$modelname];
		$m->id = $model_id;
		$commentOnThis = $m->read();
		if(empty($commentOnThis))
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
			
		$newid = $this->Comment->commentOnModel($modelname, $model_id, $parent_id, $userdata['User']['id'], $this->params['form']['text']);
		return json_encode(array("tag"=>$tag, 'comment_id'=>$newid));
	}
	
	public function edit($id){
		if(!empty($this->data)){
			$user_id = $this->Auth->user('id');
			$data    = $this->Comment->find('first', array('conditions'=>array('Comment.user_id'=>$user_id, 'Comment.id'=>$id)));
			if(empty($data)){
				$this->cakeError("404");
				return;
			}
			$data['Comment']['text'] = $this->data['Comment']['text'];
			if($this->Comment->save($data, array('fields'=>array('text')))){
				$this->redirect($this->Session->read('BackToComments'));
			}
		}
		else{
			$this->Session->write("BackToComments", $this->referer() . "#comment{$id}");
			$data = $this->Comment->find('first', array('fields'     =>array('Comment.id','Comment.text'),
																                  'conditions' =>array('Comment.user_id'=>$this->Auth->user('id'), 
																						                           'Comment.id'     =>$id)));
	    if(empty($data)){
				$this->cakeError('404');
			}

			$this->data = $data;
		}
	}
}
?>