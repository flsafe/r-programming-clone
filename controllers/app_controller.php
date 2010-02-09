<?php
	class AppController extends Controller{
     	public $components = array('Captcha', 'Auth',  'SanitizeUtil');
		
		function beforeRender(){
			$userdata = $this->Auth->user();
			$loggedin = !empty($userdata['User']);
			$this->set("loggedin", $loggedin); #Sets the login/logout html in the default layout

      		$this->set('sanitizeutil', $this->SanitizeUtil); #Escape html for render
		}
		
		function captcha(){
			$this->Captcha->render(); #Almost all controllers can create stuff in db. Captcha check before
		}
	}
?>