<?php
	class AppController extends Controller{
    public $components = array('Captcha', 'Auth', 'Common', 'Navigation');
    
    public $helpers = array('SanitizeUtil', 'HtmlPurifier', 'Html', 'Form', 'Translator', 'Javascript');

		/**
		 * Sets the currently selected link in the content menu (the navigation menu) and
		 * A hidden field that gives info about the currently logged in user
		 * for the client side. 
		 */
		public function beforeFilter(){
			$this->set('selected', $this->Navigation->getContentMenuSelection());
			$userdata = $this->Auth->user();
			$loggedin = !empty($userdata['User']);
			
			$this->set('loggedin', $loggedin);
			if($loggedin)
				$this->set('sessionusername', $userdata['User']['username']);
     }
		
		/**
		 * Show the captcha
		 */
		public function captcha(){
			$this->Captcha->render(); #Almost all controllers can create stuff in db. Captcha check before
		}
	}
?>