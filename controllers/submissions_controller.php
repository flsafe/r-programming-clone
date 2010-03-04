<?php
class SubmissionsController extends AppController{
	public $name       = "Submissions";
	
	public $components = array('RequestHandler', 'Security');
	
	public $uses       = array('Submission', 'Topic', 'Vote');

  public $helpers    = array('Markdown', 'SanitizeUtil', 'SyntaxHighlighter', 'Javascript', 'CommentsBuilder');
	
	/*All submissions to the current topic*/
	public $paginate   = array('limit'      => '25',
														 'order'      => array('Submission.rank'     => 'desc'),
														 'conditions' => array('Topic.current_topic' => '1'));
	
	function beforeFilter(){
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "Oops! You've got to be logged in to submit.";
	}

	function index(){
		$submissions = $this->paginate('Submission');
		$this->set('submissions', $submissions);
		$this->set('uservotes', array());
		$this->set('loggedin', false);

		$modelname ='Submission';
		$userid    = $this->Auth->user('id');
		if($userid){
			$modelids  = array();
			foreach($submissions as $m)
				$modelids[] = $m[$modelname]['id'];

			$uservotes = $this->Vote->getUserVotes($modelname, $modelids, $userid);
				
			$this->set('uservotes', $uservotes);
			$this->set('loggedin', true);
		}

		$topic = $this->Submission->Topic->findByCurrentTopic('1');
		$this->set('topic', $topic);
	}
	
	function view($id = null){
		$this->Submission->id = $id;
		$data = $this->Submission->read();
		$this->set('submission', $data);
		$this->set('loggedin', false);
		$this->set('uservotes', array());
		
		$userid = $this->Auth->user('id');
		if(isset($userid)){
			$uservotes = $this->Vote->getUserVotes("Submission", array($id), $userid);
			$this->set('uservotes', $uservotes);
			$this->set('loggedin', true);
		}
	}
	
	function review(){
		$user_id = $this->Auth->user('id');
		if(!user_id)
			return;
			
		$this->paginate   = array('limit'      => '25',
															'order'      => array('Submission.created'     => 'desc'),
															'conditions' => array('Topic.user_id' => $user_id));
															
		$usersubmissions = $this->paginate('Submission');
		$this->set('usersubmissions', $usersubmissions);
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
		$this->Submission->id = $id;
		
		if(empty($this->data)){
			$this->data = $this->Submission->read();
		}
		else{
			$this->data['Submission']['size'] = strlen($this->data['Submission']['text1']);
			if($this->Submission->save($this->data, array('title', 'description1', 'text1', 'syntax', 'size'))){
				$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
			}
		}
	}
}
?>
