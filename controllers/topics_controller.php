<?php
class TopicsController extends AppController{
	public $name       = "Topics";
	
	public $components = array('RequestHandler', 'Security');
	
	public $uses       = array('Topic', 'Vote');
	
	public $helpers    = array('Markdown', 'Javascript', 'CommentsBuilder');
	
	public $paginate = array(
		'limit'      => '12',
		'order'      => array('Topic.rank' => 'desc'),
		'conditions' => array('Topic.was_chosen'=>'0', 'Topic.current_topic'=>'0'));
		
	function beforeFilter(){
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to do that!";
	}

	function index(){
		$this->Topic->unbindModel(array('hasMany'=>array('Comment')), false);
		$topicdata = $this->paginate('Topic');
		
		$this->set('topics', $topicdata);
		$this->set('loggedin', false);
		$this->set('uservotes', array());
		
		$user_id    = $this->Auth->user('id');
		$this->set('user_id', $user_id);
		if($user_id){
			$modelname = 'Topic';

			$modelids = $this->Common->toIdArray($topicdata, 'Topic');
				
			$uservotes = $this->Vote->getUserVotes($modelname, $modelids, $user_id);
			$this->set('loggedin', true);
			$this->set('uservotes', $uservotes);
		}
	}
	
	function view($id = null){
		$this->Topic->id = $id;
		$this->data      = $this->Topic->read();
		$this->set('topic', $this->data);
		$this->set('loggedin', false);
		$this->set('uservotes', array());
		
		$userid          = $this->Auth->user('id');
		$modelname       = 'Topic';
		if($userid){
			$uservotes = $this->Vote->getUserVotes($modelname, $id, $userid);
			$this->set('uservotes', $uservotes);
			$this->set('loggedin', true);
		}
	}
	
	function review(){
		$user_id = $this->Auth->user('id');
		if(!$user_id)
			return;
			
		$this->set('user_id', $user_id);
		
		/*Get the user's submissions, so they can review them*/
		$this->paginate   = array('limit'      => '25',
															'order'      => array('Topic.created' => 'desc'),
															'conditions' => array('Topic.user_id' => $user_id));
															
		$topics  = $this->paginate('Topic');
		$this->set('topics', $topics);
		
		$modelids  = array();
		foreach($topics as $m)
			$modelids[] = $m['Topic']['id'];

		$uservotes = $this->Vote->getUserVotes('Topic', $modelids, $user_id);
		$this->set('uservotes', $uservotes);
	}
	
	function add(){
		if(empty($this->data))
			return;
			
		$this->data['Topic']['captcha_keystring'] = $this->Session->read('captcha_keystring');
		$this->data['Topic']['user_id']           = $this->Auth->user('id');

		if($this->Topic->save($this->data, array('title','text','user_id'))){
			$this->Vote->voteForModel('up', $this->Topic, $this->Topic->id, $this->Auth->user('id'));
			$this->redirect(array('controller'=>'topics', 'action'=>'index'));
		}
	}
	
	function edit($id=null){
		$this->Topic->id = $id;
		
		if(empty($this->data)){
			$topic         = $this->Topic->read();
			$topicOfTheDay = $topic['Topic']['current_topic'] != '0' || $topic['Topic']['was_chosen'] != '0';
			
			if($topicOfTheDay){
				$this->data = null;
				$this->Session->setFlash("You can't edit the topic of the day!");
				return;
			}
			$this->data = $topic;
		}
		else{
			$topicOfTheDay = $this->data['Topic']['current_topic'] != '0' || $this->data['Topic']['was_chosen'] != '0';
			if($topicOfTheDay){
				$this->Session->setFlash("You can't edit the topic of the day!");
				return;
			}
				
			if($this->Topic->save($this->data, array('title', 'text'))){
				$this->redirect(array('controller'=>'topics', 'action'=>'index'));
			}
		}
	}
}
?>
