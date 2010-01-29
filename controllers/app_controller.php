<?php
	class AppController extends Controller{
		public $components = array("Captcha");
		
		function captcha(){
			$this->Captcha->render();
		}
	}
?>