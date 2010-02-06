<?php
class TopicsController extends AppController{
	public $name    = "Topics";
	
	public $components = array('RequestHandler');
	
	public $uses = array('Topic', 'Vote');
	
	public $paginate = array(
		'limit'      =>'12',
		'order'      => array('Topic.rank' => 'desc'),
		'conditions' => array('Topic.was_chosen'=>'0', 'Topic.current_topic'=>'0'));
		
	function beforeFilter(){
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to submit a topic!";
	}

	function index(){
		$topics = $this->paginate('Topic');
		
		$topicids = array();
		foreach($topics as $topic)
			$topicids[] = $topic['Topic']['id'];
		
		$uservotes = array();
		if($this->Auth->user('id'))
			$uservotes = $this->Vote->getUserVotes($this->Topic, $topicids, $this->Auth->user('id'));
			
		$this->set('uservotes', $uservotes);
		$this->set('topics', $topics);
	}
	
	function view($id = null){
		$this->Topic->id = $id;
		$this->data = $this->Topic->read();
		$this->set('topic', $this->data);
	}
	
	function add(){
		if(empty($this->data))
			return;
			
		$this->data['Topic']['captcha_keystring'] = $this->Session->read('captcha_keystring');
		$this->data['Topic']['user_id']           = $this->Auth->user('id');

		if($this->Topic->save($this->data)){
			$this->redirect(array('controller'=>'topics', 'action'=>'index'));
		}
	}
	
	function vote($type = null, $id = null){
		$this->autoRender = false;

		if($this->RequestHandler->isAjax()){
			$points = $this->Vote->voteForModel($type, $this->Topic, $id, $this->Auth->user('id'));
			echo json_encode(array('points'=>$points));
		}
	}
}
?>
