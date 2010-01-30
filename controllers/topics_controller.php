<?php
class TopicsController extends AppController{
	public $name    = "Topics";
	
	public $paginate = array(
		'limit'      =>'25',
		'order'      =>array('Topic.rank' => 'asc'),
		'conditions' => array('Topic.was_chosen'=>'0', 'Topic.current_topic'=>'0'));
		
	function beforeFilter(){
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to submit a topic!";
	}

	function index(){
		$topics = $this->paginate('Topic');
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
			$this->Session->setFlash("You've submitted your topic!");
			$this->redirect(array('controller'=>'topics', 'action'=>'index'));
		}
	}
}
?>