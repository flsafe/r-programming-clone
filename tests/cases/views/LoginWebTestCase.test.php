<?php

App::import('Model', 'Model');
App::import('Vendor', 'selenium/selenium');
App::import('Core', 'Configure');

class LoginWebTestCase extends CakeWebTestCase{
	
	private $selenium;
	
	private $browserUrl;
	
	private $model;
	
	public function __construct(){
		$this->model      = new Model(false, false, null);
		
		$this->browserUrl = Configure::read('browserUrl');
		$this->selenium   = new Testing_Selenium("*mock", $this->browserUrl);
		$this->selenium->start();
	}
	
	public function before($methodName){
		$this->model->query('TRUNCATE table topics;');
		$this->model->query('TRUNCATE TABLE votes;');
		$this->model->query('TRUNCATE TABLE algorithms_topics;');
		$this->model->query('TRUNCATE TABLE data_structures_topics;');
		$this->model->query('TRUNCATE TABLE search_index;');
		$this->model->query('TRUNCATE TABLE tickets;');
		$this->model->query('TRUNCATE TABLE users;');
		$this->model->query('TRUNCATE TABLE comments;');
												
		$this->model->query("insert into users (id, username, email, password) values (LAST_INSERT_ID(), 'user', 'user@mail.com', '104ebb054ccb8abe19738875ad5b5626897841d0');");
	}
	
	public function testLogin(){
		
		$this->assertEqual(true, true);
	}
}
?>