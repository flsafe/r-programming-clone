<?php
class TopicsController extends AppController{
	public $name    = "Topics";
	
	public $components = array('RequestHandler', 'Security');
	
	public $uses = array('Topic', 'Vote');
	
	public $helpers = array('Markdown');
	
	public $paginate = array(
		'limit'      =>'12',
		'order'      => array('Topic.rank' => 'desc'),
		'conditions' => array('Topic.was_chosen'=>'0', 'Topic.current_topic'=>'0'));
		
	function beforeFilter(){
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to submit a topic!";
	}

	function index(){
		$topicdata = $this->paginate('Topic');
		$this->set('topics', $topicdata);
		
		$userid    = $this->Auth->user('id');
		$modelname = 'Topic';
		if($userid){
			$modelids  = array();
			foreach($topicdata as $m)
				$modelids[] = $m[$modelname]['id'];

			$uservotes = array();
				if($userid)
					$uservotes = $this->Vote->getUserVotes($modelname, $modelids, $userid);
				
			$this->set('uservotes', $uservotes);
		}
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

		if($this->Topic->save($this->data,
                          array('title','text','user_id'))){

			$this->Vote->voteForModel('up', $this->Topic, $this->Topic->id, $this->Auth->user('id'));
			$this->redirect(array('controller'=>'topics', 'action'=>'index'));
		}
	}
}
?>
