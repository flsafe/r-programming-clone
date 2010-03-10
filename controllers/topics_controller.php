<?php
class TopicsController extends AppController{
	public $name       = "Topics";
	
	public $components = array('RequestHandler', 'Security', 'LineItem');
	
	public $uses       = array('Topic', 'Vote');
	
	public $helpers    = array('Markdown', 'Javascript', 'CommentsBuilder');
	
	public $paginate   = array('limit'       => '25',
															'order'      => array('Topic.rank' => 'desc'),
															'conditions' => array('Topic.was_chosen'=>'0', 'Topic.current_topic'=>'0'));
		
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to do that!";
	}

	function index(){
		$this->LineItem->showIndex($this->Topic);
	}
	
	function view($id = null){
		$this->LineItem->showView($this->Topic, $id);
	}
	
	function add(){
		if(!empty($this->data)){
			$this->data['Topic']['captcha_keystring'] = $this->Session->read('captcha_keystring');
			$this->data['Topic']['user_id']           = $this->Auth->user('id');

			if($this->Topic->saveAll($this->data, array('title','text','user_id'))){
				$this->Vote->voteForModel('up', $this->Topic, $this->Topic->id, $this->Auth->user('id'));
				$this->redirect(array('controller'=>'topics', 'action'=>'index'));
			}
		}
		else{
			$structs = $this->__getStructsLists();
			$this->set('dataStructures', $structs['datastructs']);
			$this->set('algorithms', $structs['algorithms']);
		}
	}
	
	function edit($id=null){
		if(!empty($this->data)){
			$data = $this->Common->getUserOwned($this->Topic, $id, $this->Auth->user('id'));
			if(!$data)
				return;
				
			$topicOfTheDay = $data['Topic']['current_topic'] != '0' || $data['Topic']['was_chosen'] != '0';
			if($topicOfTheDay){
				$this->Session->setFlash("You can't edit the topic of the day!");
				return;
			}
			
			$data['Topic']['title'] = $this->data['Topic']['title'];
			$data['Topic']['text']  = $this->data['Topic']['text'];
			
			if($this->Topic->save($this->data)){
				$this->redirect(array('controller'=>'topics', 'action'=>'index'));
			}
		}
		else{
			$data = $this->Common->getUserOwned($this->Topic, $id, $this->Auth->user('id'));
			if(!$data)
				return;

			$topicOfTheDay = $data['Topic']['current_topic'] != '0' || $data['Topic']['was_chosen'] != '0';
			
			if($topicOfTheDay){
				$this->Session->setFlash("You can't edit the topic of the day!");
				return;
			}
			$structs = $this->__getStructsLists();
			$this->set('dataStructures', $structs['datastructs']);
			$this->set('algorithms', $structs['algorithms']);
			$this->data = $data;
		}
	}
	
	function __getStructsLists(){
		$datastructs = $this->Topic->DataStructure->find('list', array('fields'=>array('id', 'name'),
																																	 'order' =>array('DataStructure.name')));
																																	
		$algorithms  = $this->Topic->Algorithm->find('list', array('fields'    =>array('id', 'name'),
																															 'order'     =>array('Algorithm.name')));
		
		return array('datastructs'=>$datastructs, 'algorithms'=>$algorithms);
	}
}
?>
