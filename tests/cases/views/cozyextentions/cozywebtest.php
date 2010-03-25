<?php
App::import('Model', 'Model');
App::import('Vendor', 'selenium/selenium');
App::import('Core', 'Configure');

class PHPUnit_Framework_AssertionFailedError extends Exception{
	public function __construct(){
		parent::__construct();
	}
}

class CozyWebTestCase extends CakeWebTestCase{
	
	static $seleniumServer = false;
	
	protected $selenium;
	
	protected $browserUrl;
	
	protected $model;
	
	public function __construct(){
		parent::__construct();
		
		$this->model      = new Model(false, false, null);
		
		$this->browserUrl = Configure::read('browserUrl');
		
		if(! self::$seleniumServer){
			self::$seleniumServer = new Testing_Selenium("*firefox", $this->browserUrl);
			$this->selenium = self::$seleniumServer;
			$this->selenium->start();
	  }
		$this->selenium = self::$seleniumServer;
	}
	
	public function assertEquals($item1, $item2){
		$this->assertEqual($item1, $item2);
	}
	
	private function clearTables(){
		$this->model->query('TRUNCATE TABLE algorithms_topics;');
		$this->model->query('TRUNCATE TABLE comments;');
		$this->model->query('TRUNCATE TABLE data_structures_topics;');
		$this->model->query('TRUNCATE TABLE search_index;');
		$this->model->query('TRUNCATE TABLE submissions');
		$this->model->query('TRUNCATE TABLE tickets;');
		$this->model->query('TRUNCATE table topics;');
		$this->model->query('TRUNCATE TABLE users;');
		$this->model->query('TRUNCATE TABLE votes;');
												
		$this->model->query("insert into users (id, username, email, password) values (LAST_INSERT_ID(), 'user', 'user@mail.com', '104ebb054ccb8abe19738875ad5b5626897841d0');");
	}
	
	public function before($methodName){
		$this->clearTables();
	}
	
	public function after($methodName){
		$this->clearTables();
	}
}
?>