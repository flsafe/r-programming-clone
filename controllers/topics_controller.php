<?php
class TopicsController extends AppController{
	public $name       = "Topics";
	
	public $components = array('RequestHandler', 'Security', 'LineItem');
	
	public $uses       = array('Topic', 'Vote');
	
	public $helpers    = array('Markdown', 'CommentsBuilder', 'SyntaxHighlighter');

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'view'));
		$this->Auth->authError = "You've got to be logged in to do that!";
	}

	function index(){
		#
		#This is the home page. Displays the list of puzzles.
		#
		
		$this->paginate   = array('limit'  => '25',
											        'order'  => array('Topic.rank' => 'desc'));
		$this->LineItem->showIndex($this->Topic);
	}
	
	function view($topic_id){
		#
		# Displays the selected topic and the submissions associated with
		# the topic
		#
		
		$this->Topic->bindModel(array('hasMany'=>array(
																	 'Submission'=>array('className'=>'Submission'))));
																		
		$this->paginate = array('limit'      => '25',
												    'order'      => array('Submission.rank'     => 'desc'),
											      'conditions' => array('Submission.topic_id' => $topic_id));
		$this->LineItem->showIndex($this->Topic->Submission);
		
		$this->set('topic', $this->Topic->findById($topic_id));
	}
	
	function add(){
		#
		#Add a new topic
		#
		
		if(!empty($this->data)){
			$this->data['Topic']['captcha_keystring'] = $this->Session->read('captcha_keystring');
			$this->data['Topic']['user_id']           = $this->Auth->user('id');

			if($this->Topic->saveAll($this->data, array('title','text','user_id'))){
				$this->Vote->voteForModel('up', $this->Topic, $this->Topic->id, $this->Auth->user('id'));
				$this->redirect(array('controller'=>'topics', 'action'=>'index'));
			}
		}

		$structs = $this->__getStructsLists();
		$this->set('dataStructures', $structs['datastructs']);
		$this->set('algorithms', $structs['algorithms']);
	}
	
	function add_submission($id = null){
		#
		#Posts a solution to the topic specified by $id
		#
		
		if(!empty($this->data)){
			$user_id = $this->Auth->user('id');			
			$this->data['Submission']['user_id'] = $user_id;		
			$this->data['Submission']['size']    = strlen($this->data['Submission']['text1']);
			
			$this->data['Submission']['captcha_keystring'] = $this->Session->read('captcha_keystring');
		
			$this->Topic->bindModel(array('hasMany'=>array(
																	 'Submission'=>
																		 array('className'=>'Submission'))));
			$topic    = $this->Topic->findById($id);

			$this->data['Submission']['topic_id'] = $topic['Topic']['id'];
		
			if($this->Topic->Submission->save($this->data,
	                               array('user_id', 
																			 'topic_id', 
																			 'size', 
																			 'title', 
																			 'text1', 
																			 'syntax'))){
																					
	      $this->Vote->voteForModel('up', $this->Topic->Submission, 
																				$this->Topic->Submission->id, 
																				$this->Auth->user('id'));
				$this->redirect(array('controller'=>'topics', 
															'action'=>'view', 
															'id'=>$topic['Topic']['id']));
			}
		}
		$this->set('topic_id', $id);
	}
	
	function edit($id=null){
		#
		# Edit the topic specified by $id
		#
		
		if(!empty($this->data)){
			$data = $this->Common->getUserOwned($this->Topic, $id, $this->Auth->user('id'));
			if(!$data)
				return;

			$data['Topic']['title'] = $this->data['Topic']['title'];
			$data['Topic']['text']  = $this->data['Topic']['text'];
			
			if($this->Topic->save($this->data)){
				$this->redirect(array('controller'=>'topics', 'action'=>'view', 'id'=>$id));
			}
		}
		else{
			$data = $this->Common->getUserOwned($this->Topic, $id, $this->Auth->user('id'));
			if(!$data)
				return;

			$structs = $this->__getStructsLists();
			$this->set('dataStructures', $structs['datastructs']);
			$this->set('algorithms', $structs['algorithms']);
			$this->data = $data;
		}
	}
	
	function __getStructsLists(){
		$datastructs = $this->Topic->DataStructure->find('list', 
																										array('fields'=>array('id', 'name'),
																													'order' =>array('DataStructure.name')));
																																	
		$algorithms  = $this->Topic->Algorithm->find('list', 
																								 array('fields'   =>array('id', 'name'),
																											 'order'    =>array('Algorithm.name')));
		
		return array('datastructs'=>$datastructs, 'algorithms'=>$algorithms);
	}
}
?>
