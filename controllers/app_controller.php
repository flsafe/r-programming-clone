<?php
	class AppController extends Controller{
		public $components = array("Captcha", "Auth");
		
		function beforeRender(){
			$userdata = $this->Auth->user();
			$loggedin = !empty($userdata['User']);
			$this->set("loggedin", $loggedin); #Sets the login/logout html in the default layout
		}
		
		function captcha(){
			$this->Captcha->render(); #Almost all controllers can create stuff in db. Captcha check before
		}
	}
?>