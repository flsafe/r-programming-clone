<?php
class UsersController extends AppController{
	public $name        = "Users";
	public $components  = array('Auth', 'Email');
	
	function beforeFilter(){
		$this->Auth->allow('register_new_user', 'forgot_password');
	}
	
	function edit_user(){
		if(empty($this->data))
			return;
		
		
	}
	
	function register_new_user(){
		if(empty($this->data))
			return;
			
		if($this->data['User']['password_new'] == ($this->data['User']['password_confirm'])){
			$this->data['User']['password'] = $this->Auth->password($this->data['User']['password_new']);
			
			if($this->User->save($this->data)){
				$this->Session->setFlash("You have been registered!");
				$this->redirect(array('controller'=>'submissions'));
			}
			$this->data['User']['password_new']     = null;
			$this->data['User']['password_confirm'] = null;
	 	}
		else{
			$this->Session->setFlash("Passwords did not match", array('controller'=>'users', 'action'=>'register_new_user'));
			$this->redirect(array('controller'=>'users', 'action'=>'register_new_user'));
		}
	}
	
	function forgot_password(){
		if(!$this->data)
			return;

		$username = $this->data['User']['username'];
		$email    = $this->data['User']['email'];
		$userdata = $this->User->find('first', array('conditions'=>array('username'=>"$username", 'email'=>"$email")));
		
		if($userdata){
			$prevpassword = $userdata['User']['password'];
			$randpassword = substr(md5(uniqid(mt_rand(), true)), 0, 10);
			$userdata['User']['password'] = $this->Auth->password($randpassword);
			
			if($this->User->save($userdata, false, array('password'))){
				$this->Email->from    = 'CozySystems';
				$this->Email->to      = 'francisco.licea@gmail.com';
				$this->Email->subject = "Rest Password";
				
				if($this->Email->send("Your password has been reset to $randpassword")){
					echo("previous: $prevpassword<br/>");
					echo("new: $randpassword<br/>");
					//$this->Session->setFlash("We've reset your password. Check your email to get your new password.");
					//$this->redirect(array('controller' =>'submissions', 'action'=>'index'));
				}
				else{
					$userdata['User']['password'] = $prevpassword;
					$this->User->save($userdata, false, array('password'));
					$this->Session->setFlash("Sorry, we encountered a server error and could not reset your password. Try again later.");
					$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
				}
			}
		}
		else{
			$this->Session->setflash("Sorry, the username and password did not match any of our records.");
			$this->redirect(array('controller'=>'users', 'action'=>'forgot_password'));
		}
	}
	
	function login(){
		#Nothing here for now.
	}
	
	function logout(){
		$this->redirect($this->Auth->logout());
	}
}
?>