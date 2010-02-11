<?php
	class AppController extends Controller{
    public $components = array('Captcha', 'Auth');
    
    public $helpers = array('SanitizeUtil', 'Html', 'Form');
		
		function beforeRender(){
			$userdata = $this->Auth->user();
			$loggedin = !empty($userdata['User']);
			
			$this->set('loggedin', $loggedin);
			if($loggedin)
				$this->set('sessionusername', $userdata['User']['username']);
    	}
		
		function captcha(){
			$this->Captcha->render(); #Almost all controllers can create stuff in db. Captcha check before
		}
	}
?>