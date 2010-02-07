<?php
class SubmissionsController extends AppController{
	public $name = "Submissions";
	
	public $components = array('RequestHandler', 'VoteUtil');
	
	public $uses = array('Submission', 'Topic', 'Vote');
	
	public $paginate = array(
			'limit'      => '25',
			'order'      => array('Submission.upvotes'  => 'desc'),
			'conditions' => array('Topic.current_topic' => '1'));
	
	function beforeFilter(){
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "Oops! You've got to be logged in to submit.";
	}

	function index(){
		$submissions = $this->paginate('Submission');
		$this->set('submissions', $submissions);
		
		$uservotes = $this->VoteUtil->getUserVotes($this->Submission->name, $submissions, $this->Vote, $this->Auth->user('id'));
		$this->set('uservotes', $uservotes);

		$topic = $this->Submission->Topic->findByCurrentTopic('1');
		$this->set('topic', $topic);
	}
	
	function view($id = null){
		$this->Submission->id = $id;
		$data = $this->Submission->read();
		$this->set('submission', $data);
	}
	
	function add(){
		if(empty($this->data))
			return;						
			
		$user_id = $this->Auth->user('id');			
		$this->data['Submission']['user_id'] = $user_id;		
		$this->data['Submission']['size']    = strlen($this->data['Submission']['text1']);
			
		$this->data['Submission']['captcha_keystring'] = $this->Session->read('captcha_keystring');
		$this->data['Submission']['user_id']           = $this->Auth->user('id');
		
		$topic    = $this->Submission->Topic->findByCurrentTopic('1');
		$topic_id = $topic['Topic']['id'];
		$this->data['Submission']['topic_id'] = $topic_id;
		
		if($this->Submission->save($this->data)){
			$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
		}
	}
	
	function vote($type = null, $id = null){
		$this->autoRender = false;
		$resp = $this->VoteUtil->vote($this->RequestHandler->isAjax(), $type, $this->Submission, $this->Vote, $id, $this->Auth->user('id'));
		echo $resp;
	}
}
?>
