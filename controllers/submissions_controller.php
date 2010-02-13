<?php
class SubmissionsController extends AppController{
	public $name       = "Submissions";
	
	public $components = array('RequestHandler', 'VoteUtil', 'Security');
	
	public $uses       = array('Submission', 'Topic', 'Vote');

  public $helpers    = array('Markdown', 'SyntaxHighlighter');
	
	public $paginate = array(
			'limit'      => '25',
			'order'      => array('Submission.rank'  => 'desc'),
			'conditions' => array('Topic.current_topic' => '1'));
	
	function beforeFilter(){
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "Oops! You've got to be logged in to submit.";
	}

	function index(){
		$submissions = $this->paginate('Submission');
		$this->set('submissions', $submissions);
		
		$uservotes   = $this->VoteUtil->getUserVotes($this->Submission->name, $submissions, $this->Vote, $this->Auth->user('id'));
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
		
		$topic    = $this->Submission->Topic->findByCurrentTopic('1');
		$topic_id = $topic['Topic']['id'];
		$this->data['Submission']['topic_id'] = $topic_id;
		
		if($this->Submission->save($this->data,
                               array('user_id', 'topic_id', 'size', 'title', 'description1', 'text1'))){

      $this->Vote->voteForModel('up', $this->Submission, $this->Submission->id, $this->Auth->user('id'));
			$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
		}
	}
}
?>
