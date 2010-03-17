<?php
class ContactsController extends AppController{
	public $name = "Contacts";
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('add'));
	}
	
	public function add(){
		if(!empty($this->data)){
			if($this->Contact->save($this->data, array('name', 'email', 'feedback'))){
				$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
			}
		}
	}
}
?>