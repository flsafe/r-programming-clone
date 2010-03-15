<?php
class SubmissionsController extends AppController{
	public $name       = "Submissions";
	
	public $components = array('RequestHandler', 'Security', 'LineItem');
	
	public $uses       = array('Submission', 'Vote', 'Topic');

  public $helpers    = array('Markdown', 'SyntaxHighlighter', 'CommentsBuilder', 'Cache');
	
	/*All submissions to the current topic*/
	public $paginate   = array('limit'      => '25',
														 'order'      => array('Submission.rank'     => 'desc'),
														 'conditions' => array('Topic.current_topic' => '1'));
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to do that!";
	}

	/*
		This is the home page
	*/
	function index(){
		$this->LineItem->showIndex($this->Submission);
		$this->Topic->updateSelectedTopic();
		$this->set('topic', $this->Submission->Topic->findByCurrentTopic('1'));
	}
	
	function view($id = null){
		$this->LineItem->showView($this->Submission, $id);
	}
	
	function add(){
		if(empty($this->data))
			return;						
			
		$user_id = $this->Auth->user('id');			
		$this->data['Submission']['user_id'] = $user_id;		
		$this->data['Submission']['size']    = strlen($this->data['Submission']['text1']);
			
		$this->data['Submission']['captcha_keystring'] = $this->Session->read('captcha_keystring');
		
		$topic    = $this->Submission->Topic->findByCurrentTopic('1');
		$topic_id = $topic['Topic']['id'];
		$this->data['Submission']['topic_id'] = $topic_id;
		
		if($this->Submission->save($this->data,
                               array('user_id', 
																		 'topic_id', 
																		 'size', 
																		 'title', 
																		 'description1', 
																		 'text1', 
																		 'syntax'))){

      $this->Vote->voteForModel('up', $this->Submission, $this->Submission->id, $this->Auth->user('id'));
			$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
		}
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
				$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
			}
		}
	}
}
?>
