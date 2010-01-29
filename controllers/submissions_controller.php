<?php
class SubmissionsController extends AppController{
	public $name       = "Submissions";
	public $components = array("Auth");
	
	function beforeFilter(){
		$this->Auth->allow(array("index"));
		$this->Auth->authError = "Oops! You've got to be logged in to submit.";
	}

	function index(){
		#show main page
	}
	
	function add_new_submission(){
		if(empty($this->data))
			return;						
			
		$user_id = $this->Auth->user('id');			
		$this->data['Submission']['user_id'] = $user_id;		
		$this->data['Submission']['size']    = strlen($this->data['Submission']['text1']);
			
		if($this->Submission->save($this->data)){
			$this->Session->setFlash("You've submitted your solution!");
			$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
		}
	}
}
?>
