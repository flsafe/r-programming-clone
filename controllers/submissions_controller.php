<?php
class SubmissionsController extends AppController{
	public $name = "Submissions";
	
	public $uses = array('Submission', 'Topic');
	
	public $paginate = array(
			'limit'      => '25',
			'order'      => array('Submission.upvotes'  => 'asc'),
			'conditions' => array('Topic.current_topic' => '1'));
	
	function beforeFilter(){
		$this->Auth->allow(array("index"));
		$this->Auth->authError = "Oops! You've got to be logged in to submit.";
	}

	function index(){
		$submissions = $this->paginate('Submission');
		$this->set('submissions', $submissions);
		
		$topic = $this->Submission->Topic->findByCurrentTopic('1');
		$this->set('topic', $topic);
	}
	
	function add(){
		if(empty($this->data))
			return;
			
		$this->data['Submission']['captcha_keystring'] = $this->Session->read('captcha_keystring');
		$this->data['Submission']['user_id']           = $this->Auth->user('id');
		
		$topic    = $this->Submission->Topic->findByCurrentTopic('1');
		$topic_id = $topic['Topic']['id'];
		$this->data['Submission']['topic_id'] = $topic_id;
		
		if($this->Submission->save($this->data)){
			$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
		}
	}
}
?>