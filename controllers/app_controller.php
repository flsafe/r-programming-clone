<?php
	class AppController extends Controller{
    public $components = array('Captcha', 'Auth', 'Common', 'Navigation', 'Session');
    
    public $helpers = array('SanitizeUtil', 'Html', 'Form', 'Translator', 'Javascript', 'Session');

		public function beforeFilter(){
		  #
		  # Sets the currently selected link in the content menu (the navigation menu) and
		  # A hidden field that gives info about the currently logged in user
		  # for the client side javascript. 
		  #

			$this->Navigation->setContentMenuSelection();
     }
		
		public function captcha(){
			#
			#Displays the captcha image
			#
			
			$this->Captcha->render();
		}
	}
?>