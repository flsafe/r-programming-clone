<?php
class SubmissionsController extends AppController{
	public $name       = "Submissions";
	
	public $components = array('RequestHandler', 'Security', 'LineItem');
	
	public $uses       = array('Submission', 'Vote', 'Topic');

  public $helpers    = array('Markdown', 'SyntaxHighlighter', 'CommentsBuilder', 'Session');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to do that!";
	}
	
	function view($id = null){
		$this->LineItem->showView($this->Submission, $id);
	}
	
	function edit($id = null){
		if(empty($this->data)){
			$data = $this->Common->getUserOwned($this->Submission, $id, $this->Auth->user('id'));
		  if(!$data){
				$this->Session->setFlash('Ooops!');
				$this->cakeError('error404');
			}
			$this->data = $data;
		}
		else{
			$data = $this->Common->getUserOwned($this->Submission, $id, $this->Auth->user('id'));
			if(!$data){
				$this->cakeError('error404');
			}

			$data['Submission']['title']        = $this->data['Submission']['title'];
			$data['Submission']['description1'] = $this->data['Submission']['description1'];
			$data['Submission']['text1']        = $this->data['Submission']['text1'];
			$data['Submission']['syntax']       = $this->data['Submission']['syntax'];
			$data['Submission']['size']         = strlen($this->data['Submission']['text1']);

			if($this->Submission->save($data)){
				$this->redirect(array('controller'=>'submissions', 'action'=>'view', 'id'=>$id));
			}
		}
	}
}
?>
