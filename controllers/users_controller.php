<?php
class UsersController extends AppController{
	public $name        = "Users";
	
	public $components  = array('Auth', 'Email','Session', 'Security', 'Ticket');
	
	function beforeFilter(){
		$this->Auth->allow('add', 'forgot_password','reset_password', 'captcha');
	}
	
	function edit(){
		$this->User->id = $this->Auth->user('id');
		
		if(empty($this->data)){
			$this->data = $this->User->read();
			$this->set('userid', $this->User->id);
		}
		else{
			$this->User->save($this->data, array('email'));
			$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
		}
	}
	
	function change_password($userid){
		if(!empty($this->data)){
			$idmatch = $this->data['User']['id'] == $this->Auth->user('id');
			if(!$idmatch)
				return;
				
			$providedpass = $this->data['User']['password_current'];
			$data         = $this->User->read();	
			$userpass     = $data['User']['password'];
	
			if($this->Auth->password($providedpass) == $userpass){
				$newpass = $this->Auth->password($this->data['User']['password_new']);
				$this->data['User']['password'] = $newpass;
		
				if($this->User->save($this->data, array('password'))){
					$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
				}/*Else, the validation rules failed. There is no redirect so that the errors show*/
			}
			else{
				$this->Session->setFlash("Incorrect Password");
			}
		}
		else{
			$this->data['User']['id'] = $userid;
		}
	}
	
	function add(){
		if(empty($this->data))
			return;
			
			/*Avoid the cakephp auto hash by using 'password_new' in the form to validate unhashed password*/
			$this->data['User']['password']          = $this->Auth->password($this->data['User']['password_new']);
			$this->data['User']['captcha_keystring'] = $this->Session->read('captcha_keystring');
			
			if($this->User->save($this->data, 
                           array('username', 'password','email'))){

				$this->Auth->login(array('username'=>$this->data['User']['username'],
																 'password'=>$this->data['User']['password']));
				$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
			}
			$this->data['User']['password'] = null;
			$this->render("login");
		}	
	
	function forgot_password(){
		if(!$this->data)
			return;

		$username = $this->data['User']['username'];
		$email    = $this->data['User']['email'];
		$userdata = $this->User->find('first', array('conditions'=>array('username'=>"$username", 'email'=>"$email")));
		
		if(!empty($userdata)){
			$this->Email->from    = 'CodeKettl';
			$this->Email->to      = 'francisco.licea@gmail.com'; #TODO: Session user's email is hard-coded
			$this->Email->subject = "Reset Password";
			$ticket               = $this->Ticket->set($userdata['User']['email']);
      
			if($this->Email->send("To reset your password: http://www.codekettl.com/users/reset_password/ticket:$ticket"))
				$this->Session->setFlash("We've sent an email to reset your password. Check your email.");
			else
				$this->Session->setFlash("Sorry, we encountered a server error and could not reset your password. Try again later.");
		}
		else{
			$this->Session->setflash("Sorry, the username and password did not match any of our records.");
		}
	}
	
	function reset_password(){
    $ticket = isset($this->passedArgs['ticket']) ? $this->passedArgs['ticket'] : null;

		if($ticket && empty($this->data)){
			
			$ticketdata = $this->Ticket->get($ticket);

			if(empty($ticketdata))
				$this->Session->setFlash("Invalid Ticket");
			else
				$this->set('ticket', $ticket);
		}
		else if($ticket && !empty($this->data)){
			$userdata = $this->User->findByEmail($this->Ticket->get($ticket));

			if(empty($userdata)){
				$this->Session->setFlash("Invalid Ticket");
			}
			else{
        $userdata['User']['password']         = $this->Auth->password($this->data['User']['password_new']);
        $userdata['User']['password_new']     = $this->data['User']['password_new'];
        $userdata['User']['password_confirm'] = $this->data['User']['password_confirm'];

        if($this->User->save($userdata, array('password'))){
          $this->Ticket->del($ticket);
          $this->Auth->login(array('username'=>$userdata['User']['username'], 'password'=>$userdata['User']['password']));
          $this->Session->setFlash("We've updated your password!");
          $this->redirect(array('controller'=>'submissions', 'action'=>'index'));
        }
			}
		}
	}
	
	function login(){
		#Nothing here for now.
	}
	
	function logout(){
		$this->Auth->logout();
		$this->redirect(array('controller'=>'submissions', 'action'=>'index'));
	}
}
?>
