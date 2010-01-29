<?php
class UsersController extends AppController{
	public $name        = "Users";
	public $components  = array('Auth', 'Email','Session');
	
	function beforeFilter(){
		$this->Auth->allow('register_new_user', 'forgot_password', 'captcha');
	}
	
	function edit_user(){
		$this->User->id = $this->Auth->user('id');
		
		if(empty($this->data)){
			$this->data = $this->User->read();
		}
		else{
			$idmatch = $this->data['User']['id'] == $this->Auth->user('id');
			
			if(!$idmatch)
				return;
			
			$providedpass = $this->data['User']['password_current'];
			$data         = $this->User->read();	
			$userpass     = $data['User']['password'];
			
			if(empty($providedpass)){
				$this->data['User']['password_new']     = 'abcdefg'; #Dummy password to get past validation
				$this->data['User']['password_confirm'] = 'abcdefg';
				
				if($this->User->save($this->data)){
					$this->Session->setFlash("We've updated your info!");
					$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
				}		
			}
			else{
						
				if($this->Auth->password($providedpass) == $userpass){
					$newpass = $this->Auth->password($this->data['User']['password_new']);
					$this->data['User']['password'] = $newpass;
					
					if($this->User->save($this->data)){
						$this->Session->setFlash("We've updated your info!");
						$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
					}
				}
				else{
					$this->Session->setFlash("Incorrect password");
				}
			}
				
		}
		$this->data['User']['password_new']     = null;
		$this->data['User']['password_confirm'] = null;					
	}
	
	function register_new_user(){
		if(empty($this->data))
			return;

			#Avoid the cakephp auto hash, inorder to validate unhashed password
			$this->data['User']['password']          = $this->Auth->password($this->data['User']['password_new']);
			$this->data['User']['captcha_keystring'] = $this->Session->read('captcha_keystring');
			
			if($this->User->save($this->data)){
				$this->Session->setFlash("You have been registered!");
				$this->redirect(array('controller'=>'submissions'));
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
				$this->Email->to      = 'francisco.licea@gmail.com'; #TODO: Session user's email is hard-coded
				$this->Email->subject = "Rest Password";
				
				if($this->Email->send("Your password has been reset to $randpassword")){
					$this->Session->setFlash("We've reset your password. Check your email to get your new password.");
					$this->redirect(array('controller' =>'submissions', 'action'=>'index'));
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
