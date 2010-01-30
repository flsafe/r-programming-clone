<?php
class SubmissionsController extends AppController{
	public $name       = "Submissions";
	
	function beforeFilter(){
		$this->Auth->allow(array("index"));
		$this->Auth->authError = "Oops! You've got to be logged in to submit.";
	}

	function index(){

	}
	
	function add_new_submission(){
		if(empty($this->data))
			return;
			
		if($this->Submission->save($this->data)){
			$this->Session->setFlash("You've submitted your solution!");
			$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
		}
	}
}
?>